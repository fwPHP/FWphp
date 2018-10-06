<?php

echo '<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="google" content="notranslate">
        <title>500 server error</title>
        <link rel="icon" href="data:,">
        <style>
        html, body{
            background: rgb(255, 255, 255);
            font-family: \'Open Sans\', sans-serif;
            font-size: 14px;
            line-height: 1.5;
            color: rgb(55, 55, 55);
        }
        *{
            margin: 0;
            padding: 0;
        }
        h1{
            padding: 10px;
            font-size: 16px;
        }
        table{
            width: 100%;
            border-collapse: collapse;
            border-top: 3px double rgb(207, 211, 221);
            border-bottom: 3px double rgb(207, 211, 221);
            margin-bottom: 20px;
        }
        p{
            padding: 6px 10px;
        }
        td.td{
            white-space: nowrap;
            vertical-align: top;
            width: 1px;
        }
        td p{
            padding-right: 0;
        }
        </style>
    </head>
    <body>
        <h1>500 server error</h1>
        <table>
            <tr>
                <td class="td"><p>Type : </p></td>
                <td><p>' . self::$type . '</p></td>
            </tr>
            <tr>
                <td class="td"><p>Message : </p></td>
                <td><p>' . self::$message . '</p></td>
            </tr>
            <tr>
                <td class="td"><p>File : </p></td>
                <td><p>' . self::$file . '</p></td>
            </tr>
            <tr>
                <td class="td"><p>Line : </p></td>
                <td><p>' . self::$line . '</p></td>
            </tr>
        </table>
    </body>
</html>';
