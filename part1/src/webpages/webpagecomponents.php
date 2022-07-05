<?php

/**
 * Components for Webpage
 *
 * This class provides static methods for creating webpage components.
 *
 * @author Graham Stoves w19025672
 */

class WebpageComponents
{
    /**
     * WebpageHead
     *
     * Generates the webpage head and accepts a title parameter and links 
     * the stylesheet
     *
     * @param string $title - the page title
     */
    public static function webpageHead($title)
    {
        return <<<EOT
        <!DOCTYPE html>
        <html lang="en-gb">
        <head>
            <title>$title</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="assets/style.css">
        </head>
        <body>
EOT;
    }

    /**
     * webpageFoot
     * 
     * Creates the foot function to pass to the webpages
     */
    public static function webpageFoot()
    {
        return <<<EOT
        </body>
        <footer>
        </footer>
        </html>
EOT;
    }

    /**
     * Menu
     *
     * Generates a menu with navbar links
     *
     * @param array $links - the page link
     * @param string $name - the page name
     * @return string
     */

    public static function menu($links)
    {
        $menu = "<nav><ul>";

        foreach ($links as $name => $link) {
            $menu .= "<li><a href='$link'>$name</a></li>";
        }

        $menu .= "</ul></nav>";
        return $menu;
    }
}