<?php

return [
    'adminEmail' => getenv('ADMIN_EMAIL'),
    'senderEmail' => getenv('SENDER_EMAIL'),
    'senderName' => getenv('SENDER_NAME'),
    'user.passwordResetTokenExpire' => 3600,
    'seoKeywords' => getenv('SEO_KEYWORDS'),
    'seoDescription' => getenv('SEO_DESCRIPTION'),
    'googleAnalyticsAU' => getenv('GOOGLE_ANALYTICS_AU'),
];
