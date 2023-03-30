# WordPress AI GPT-4 Title Generator Plugin

Auto Title Generator is a WordPress plugin that helps you automatically generate post titles using OpenAI's GPT-4 API. This plugin enhances the WordPress admin area by adding three buttons that let you create different types of titles based on the content you've written in the post editor.

## Features

- Automatically generate formal post titles
- Automatically generate clickbait titles
- Automatically generate social media-friendly titles
- Editable API key from the plugin's settings in the admin panel

## Requirements

- WordPress 5.0 or later
- PHP 7.0 or later
- OpenAI API key with access to GPT-4 (or other compatible models)

## Installation

1. Download the plugin files and upload them to the `/wp-content/plugins/auto-title-generator` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to the 'Settings' menu and click on 'Auto Title Generator' to configure the API key.
4. It should work if you use installation to a root folder. Edit url line 26 in auto-title-generator.js if you use it in subfolder
5. Feel free to edit prompts details in auto-title-generator.js file.

## Usage

While creating or editing a post, you'll see three buttons in the post editor sidebar:

1. Formal: Generates a formal and informative title based on the content.
2. Click bait: Generates a clickbait title that encourages users to click on it.
3. Social best: Generates a title that is well-suited for sharing on social media platforms like Facebook.

Click on the desired button to generate a title, and it will replace the existing title in the post editor.

## Credits

This plugin was created using ChatGPT GPT-4 by a person with no prior knowledge of PHP. The development process was guided by the AI model, which provided detailed instructions and code snippets to build the plugin from scratch.
