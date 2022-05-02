<head>
    <title>{{ page_title }}</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ this.translator.getMessage('meta-description') }}">
    <meta name="author" content="{{ this.app.getConfig('meta-author') }}">
    <meta name="theme-color" content="{{ this.app.getConfig('meta-theme-color') }}">

    <meta property="og:type" content="{{ this.app.getConfig('meta-type') }}">
    <meta property="og:url" content="{{ this.app.getConfig('meta-url') }}">
    <meta property="og:description" content="{{ this.translator.getMessage('meta-description') }}">

    <meta property="og:title" content="{{ meta_title }}">
    <meta property="og:image" content="{{ meta_image }}">

    <link rel="icon" href="/assets/favicon.png" type="image/png"/>
    <link rel="shortcut icon" href="/assets/favicon.ico"/>


    {{ this.assets.outputCss('generic.css') }}
    {{ this.assets.outputJs('generic.js') }}

</head>