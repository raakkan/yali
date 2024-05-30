<?php

namespace Raakkan\Yali\Core\Resources\Concerns;

use Illuminate\Support\Str;

trait HasTitlesAndMessages
{
    // TODO: add create page subtitle and update page subtitle
    // and create success message and update success message
    protected static $title = '';
    protected static $subtitle = '';
    protected static $createPageTitle = '';
    protected static $updatePageTitle = '';
    protected static $tablePageMessage = '';
    protected static $updatePageMessage = '';
    protected static $createPageMessage = '';
    protected static $allPageMessage = '';
    protected static $tablePageMessageType = 'info';
    protected static $updatePageMessageType = 'info';
    protected static $createPageMessageType = 'info';
    protected static $allPageMessageType = 'info';
    protected static $createSubmitButtonLabel = '';
    protected static $updateSubmitButtonLabel = '';

    public static function title(): string
    {
        return static::$title ?: Str::title(static::getModelName());
    }

    public static function getTitle(): string
    {
        return static::$title ?: Str::title(static::getModelName());
    }

    public static function getPluralTitle(): string
    {
        return Str::plural(static::getTitle());
    }

    public static function getSubtitle(): string
    {
        return static::$subtitle;
    }

    public static function getCreatePageTitle(): string
    {
        return static::$createPageTitle ?: 'Create ' . static::getTitle();
    }

    public static function getUpdatePageTitle(): string
    {
        return static::$updatePageTitle ?: 'Update ' . static::getTitle();
    }

    public static function getTablePageMessage(): string
    {
        return static::$tablePageMessage ?: (static::getAllPageMessage() ?: '');
    }

    public static function getUpdatePageMessage(): string
    {
        return static::$updatePageMessage ?: (static::getAllPageMessage() ?: '');
    }

    public static function getCreatePageMessage(): string
    {
        return static::$createPageMessage ?: (static::getAllPageMessage() ?: '');
    }

    public static function getAllPageMessage(): string
    {
        return static::$allPageMessage ?: '';
    }

    public static function getTablePageMessageType(): string
    {
        if (static::getTablePageMessage() === static::getAllPageMessage()) {
            return static::getAllPageMessageType() ?: 'info';
        }
        return static::$tablePageMessageType ?: 'info';
    }

    public static function getUpdatePageMessageType(): string
    {
        if (static::getUpdatePageMessage() === static::getAllPageMessage()) {
            return static::getAllPageMessageType() ?: 'info';
        }
        return static::$updatePageMessageType ?: 'info';
    }

    public static function getCreatePageMessageType(): string
    {
        if (static::getCreatePageMessage() === static::getAllPageMessage()) {
            return static::getAllPageMessageType() ?: 'info';
        }
        return static::$createPageMessageType ?: 'info';
    }

    public static function getAllPageMessageType(): string
    {
        return static::$allPageMessageType ?: 'info';
    }

    public static function getCreateSubmitButtonLabel(): string
    {
        return static::$createSubmitButtonLabel ?: 'Create';
    }

    public static function getUpdateSubmitButtonLabel(): string
    {
        return static::$updateSubmitButtonLabel ?: 'Update';
    }

    public static function setTitlesAndMessages(
        string $title = '',
        string $subtitle = '',
        string $createPageTitle = '',
        string $updatePageTitle = '',
        string $tablePageMessage = '',
        string $updatePageMessage = '',
        string $createPageMessage = '',
        string $allPageMessage = '',
        string $tablePageMessageType = 'info',
        string $updatePageMessageType = 'info',
        string $createPageMessageType = 'info',
        string $allPageMessageType = 'info',
        string $createSubmitButtonLabel = '',
        string $updateSubmitButtonLabel = ''
    ): void {
        static::$title = $title;
        static::$subtitle = $subtitle;
        static::$createPageTitle = $createPageTitle;
        static::$updatePageTitle = $updatePageTitle;
        static::$tablePageMessage = $tablePageMessage;
        static::$updatePageMessage = $updatePageMessage;
        static::$createPageMessage = $createPageMessage;
        static::$allPageMessage = $allPageMessage;
        static::$tablePageMessageType = $tablePageMessageType;
        static::$updatePageMessageType = $updatePageMessageType;
        static::$createPageMessageType = $createPageMessageType;
        static::$allPageMessageType = $allPageMessageType;
        static::$createSubmitButtonLabel = $createSubmitButtonLabel;
        static::$updateSubmitButtonLabel = $updateSubmitButtonLabel;
    }

    public static function getTitlesAndMessages(): array
    {
        return [
            'title' => static::$title ?: Str::title(static::getModelName()),
            'subtitle' => static::$subtitle,
            'createPageTitle' => static::$createPageTitle ?: 'Create ' . (static::$title ?: Str::title(static::getModelName())),
            'updatePageTitle' => static::$updatePageTitle ?: 'Update ' . (static::$title ?: Str::title(static::getModelName())),
            'tablePageMessage' => static::$tablePageMessage ?: (static::$allPageMessage ?: ''),
            'updatePageMessage' => static::$updatePageMessage ?: (static::$allPageMessage ?: ''),
            'createPageMessage' => static::$createPageMessage ?: (static::$allPageMessage ?: ''),
            'allPageMessage' => static::$allPageMessage ?: '',
            'tablePageMessageType' => static::$tablePageMessage === static::$allPageMessage ? (static::$allPageMessageType ?: 'info') : (static::$tablePageMessageType ?: 'info'),
            'updatePageMessageType' => static::$updatePageMessage === static::$allPageMessage ? (static::$allPageMessageType ?: 'info') : (static::$updatePageMessageType ?: 'info'),
            'createPageMessageType' => static::$createPageMessage === static::$allPageMessage ? (static::$allPageMessageType ?: 'info') : (static::$createPageMessageType ?: 'info'),
            'allPageMessageType' => static::$allPageMessageType ?: 'info',
            'createSubmitButtonLabel' => static::$createSubmitButtonLabel ?: 'Create',
            'updateSubmitButtonLabel' => static::$updateSubmitButtonLabel ?: 'Update',
        ];
    }
}
