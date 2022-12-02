<?php

namespace PHPhademic\Lib;
/**
 * A base to execute shell commands
 */
class Shell
{
    /**
     * The values of the arguments passed to the command
     */
    private array $argv;

    /**
     * The available options for the command
     * 
     * Syntax:
     * 
     * ['o' => 'option', 'l' => 'long-option', 'd' => 'description', 'r' => 'required']
     */
    private array $options;

    public const OPTION = 'o';
    public const LONG_OPTION = 'l';
    public const DESCRIPTION = 'd';
    public const REQUIRED = 'r';

    public const OPTION_REQUIRED = true;
    public const OPTION_NOT_REQUIRED = false;


    const DEFAULT_HELP_OPTION = [
        self::OPTION => 'h',
        self::LONG_OPTION => 'help',
        self::DESCRIPTION => 'Display this help message',
        self::REQUIRED => false
    ];

    /**
     * The initialisation of the command
     * 
     * @param array $argv The values of the arguments passed to the command
     * @param array $options The available options for the command (defaults to the help option)
     */
    public function __construct(
        array $argv,
        array $options = self::DEFAULT_HELP_OPTION
    ) {
        $this->argv = $argv;
        $this->options = $options;

        // Check if the help option is present
        if ($this->hasOption(self::DEFAULT_HELP_OPTION[self::OPTION]) || $this->hasOption(self::DEFAULT_HELP_OPTION[self::LONG_OPTION])) {
            $this->help();
            exit;
        }
    }

    /**
     * Return the usage of the command
     */
    protected function help(): void
    {
        echo 'Usage: ' . $this->argv[0] . ' [options]' . PHP_EOL;

        foreach ($this->options as $option) {
            $required = $option[self::REQUIRED] ? ' (required)' : '';

            echo '  -' . $option[self::OPTION] . ', --' . $option[self::LONG_OPTION] . ' ' . $option[self::DESCRIPTION] . $required . PHP_EOL;
        }
    }

    /**
     * Get the options of the command
     */
    public function getOptions(array $list) {
        // Get the options
        foreach ($list as $option) {
            $options[$option] = getopt(
                $this->options[$option][self::OPTION],
                [$this->options[$option][self::LONG_OPTION]]
            );
        }

        // Verify if the required options are set
        $errors = [];

        foreach ($this->options as $option) {
            if ($option[self::REQUIRED] && !$options[$option[self::OPTION]]) {
                $errors[] = $option[self::OPTION];
            }
        }

        if (count($errors) > 0) {
            echo 'The following options are required: ' . implode(', ', $errors) . PHP_EOL;
            exit;
        }

        return $options;
    }

    /**
     * Check if an option is present in argv
     */
    public function hasOption(string $option): bool
    {
        foreach ($this->argv as $arg) {
            if ($arg === '-' . $option || $arg === '--' . $option) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the value of an option
     */
    public function getOption(string $shortOption, string $longOption): string
    {
        $value = '';

        foreach ($this->argv as $arg) {
            if ($arg === '-' . $shortOption || $arg === '--' . $longOption) {
                $value = $this->argv[array_search($arg, $this->argv) + 1] ?? '';
            }
        }

        return $value;
    }

    /**
     * Asks the user for an input
     */
    public function ask(string $prompt, bool $required = false, $default = null, array $validValues = []): string
    {
        echo $prompt . ' ';
        $value = readline();

        if ($required && !$value) {
            echo 'This value is required' . PHP_EOL;
            return $this->ask($prompt, $required, $default, $validValues);
        }

        if ($value && count($validValues) > 0 && !in_array($value, $validValues)) {
            echo 'This value is not valid' . PHP_EOL;
            return $this->ask($prompt, $required, $default, $validValues);
        }

        if (!$value) 
            return $default;

        return $value;
    }
}