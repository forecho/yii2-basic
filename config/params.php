<?php

return [
    'adminEmail' => getenv('ADMIN_EMAIL'),
    'senderEmail' => getenv('SENDER_EMAIL'),
    'senderName' => getenv('SENDER_NAME'),
    'user.passwordResetTokenExpire' => 3600,
    'seoKeywords' => getenv('SEO_KEYWORDS'),
    'seoDescription' => getenv('SEO_DESCRIPTION'),
    'googleAnalyticsAU' => getenv('GOOGLE_ANALYTICS_AU'),
    'uploadRewardPoints' => getenv('UPLOAD_REWARD_POINTS'),
    'signInRewardPoints' => getenv('SIGN_IN_REWARD_POINTS') ?: 1, // 默认是奖励1分
    'masterPointsAccount' => getenv('MASTER_POINTS_ACCOUNT') ?: 1, // 主积分账户（用户id）默认是1
    'backblazeAccountId' => getenv('BACKBLAZE_ACCOUNT_ID'),
    'backblazeAppKey' => getenv('BACKBLAZE_APP_KEY'),
    'backblazeBucketName' => getenv('BACKBLAZE_BUCKET_NAME'),
    'bufpayAppId' => getenv('BUFPAY_APP_ID'),
    'bufpayAppSecret' => getenv('BUFPAY_APP_SECRET'),
    'wechatAppId' => getenv('WECHAT_APP_ID'),
    'wechatAppSecret' => getenv('WECHAT_APP_SECRET'),
    'wechatToken' => getenv('WECHAT_TOKEN'),
    'adImage' => getenv('AD_IMAGE'),
    'adTitle' => getenv('AD_TITLE'),
    'adsense' => [
        'client' => getenv('GOOGLE_ADSENSE_CLIENT'),
        'slot' => getenv('GOOGLE_ADSENSE_SLOT'),
        'enabled' => getenv('GOOGLE_ADSENSE_ENABLED'),
    ],
    'ossImageResizeRule' => getenv('OSS_IMAGE_RESIZE_RULE') ? '?x-oss-process=' . getenv('OSS_IMAGE_RESIZE_RULE') : '',
    'url2apiToken' => getenv('URL_2_API_TOKEN'),
    'baiduAppId' => getenv('BAIDU_APP_ID'),
    'baiduAppKey' => getenv('BAIDU_APP_KEY'),
    'baiduAppSecret' => getenv('BAIDU_APP_SECRET'),
    'baiduTranslateAppId' => getenv('BAIDU_TRANSLATE_APP_ID'),
    'baiduTranslateAppSecret' => getenv('BAIDU_TRANSLATE_APP_SECRET'),
    'allowComments' => getenv('ALLOW_COMMENTS'),
    'proxyBaseUrl' => getenv('PROXY_BASE_URL'),
    'oSChinaAppId' => getenv('OSCHINA_APP_ID'),
    'oSChinaAppSecret' => getenv('OSCHINA_APP_SECRET'),
    'translationToTw' => getenv('TRANSLATION_TO_TW') === '1'
];
