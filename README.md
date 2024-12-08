# PHP directory organizer

## Introduction

Organize your desktop or any other directory easily using PHP. Files are organized by their category :

- Documents
- Images
- Videos
- Spreadsheets
- Presentations
- Audio
- Others

## Requirements

- PHP >= 8.1

## Installation

You can install this library using composer or by cloning the git repository.

### Clone the respository

```bash
git clone git@github.com:mahdiabderraouf/php-directory-organizer.git
```

### Install with composer

```bash
composer require mahdiabderraouf/php-directory-organizer
```

## Usage

It is always recommanded to create a backup of your directory:

```bash
cp -r your-directory your-directory.bak
```

Then run the php file `organizer.php`:

```bash
php organizer.php --directory your-directory
```
