<?php

return [
    /* ------------------------------------------------------------------------------------------------
     |  Escape Cross-site scripting
     | ------------------------------------------------------------------------------------------------
     | Allowing or not to escape the JavaScript in anchor tags.
     | e.g. markdown like "[Link](javascript:alert('hello'))".
     */
    'xss' => true,

    /* ------------------------------------------------------------------------------------------------
     |  Automatically link URLs
     | ------------------------------------------------------------------------------------------------
     | Allowing or not to automatic-linking of URLs in your markdown.
     */
    'urls' => true,
];
