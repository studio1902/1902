# 1902.studio

This is the source code of [1902.studio](https://1902.studio). It's built using [Statamic](https://statamic.com) and [Statamic Peak](https://peak.1902.studio).

## License
* Statamic is paid software and his it's own [commerical license](https://github.com/statamic/cms/blob/3.3/LICENSE.md).
* Statamic Peak is open source and falls under the [MIT license](https://github.com/studio1902/statamic-peak/blob/main/LICENSE).
* The content, design and source code of this website falls under [exclusive copyright](https://choosealicense.com/no-permission/).

## Credits
The website was designed by [Merkactivisten](https://merkactivisten.nl) in collaboration with Rob de Kort. The website is built by Rob de Kort.

## Installation instructions

1. run `composer install`
2. run `php please make:user`
3. run `npm i` && `npm run watch` (or `npm run dev`)

## Environment file contents

### Development

```env
APP_NAME='Studio 1902'
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://1902.test

DEBUGBAR_ENABLED=false

LOG_CHANNEL=stack

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_DATABASE=
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=0.0.0.0
MAIL_PORT=1025
MAIL_USERNAME=testuser
MAIL_PASSWORD=testpwd
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=info@studio1902.nl
MAIL_FROM_NAME="${APP_NAME}"

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

IMAGE_MANIPULATION_DRIVER=imagick

STATAMIC_LICENSE_KEY=
STATAMIC_THEME=business

STATAMIC_API_ENABLED=false
STATAMIC_REVISIONS_ENABLED=false

STATAMIC_GIT_ENABLED=false
STATAMIC_GIT_PUSH=false
STATAMIC_GIT_DISPATCH_DELAY=5

SAVE_CACHED_IMAGES=true
STATAMIC_CACHE_TAGS_ENABLED=false
STATAMIC_STACHE_WATCHER=true
STATAMIC_STATIC_CACHING_STRATEGY=null

#STATAMIC_CUSTOM_CMS_NAME=
#STATAMIC_CUSTOM_LOGO_OUTSIDE_URL=
STATAMIC_CUSTOM_LOGO_OUTSIDE_URL='/visuals/studio1902-logo.svg'
#STATAMIC_CUSTOM_FAVICON_URL=
#STATAMIC_CUSTOM_CSS_URL=
```

### Production

```env
Dump your .env values here with sensitive data removed.
```

## NGINX config

Add the following to your NGINX config __inside the server block__ enable static resource caching:
```
expires $expires;
```

And this __outside the server block__:
```
map $sent_http_content_type $expires {
    default    off;
    text/css    max;
    ~image/    max;
    application/javascript    max;
    application/octet-stream    max;
}
```

## Deploy script Ploi

```bash
if [[ {COMMIT_MESSAGE} =~ "[BOT]" ]]; then
    echo "Automatically committed on production. Nothing to deploy."
    {DO_NOT_NOTIFY}
    # Uncomment the following line when using zero downtime deployments.
    # {CLEAR_NEW_RELEASE}
    exit 0
fi

cd {SITE_DIRECTORY}
git pull origin main
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

npm ci
npm run production
php{SITE_PHP_VERSION} artisan cache:clear
php{SITE_PHP_VERSION} artisan config:cache
php{SITE_PHP_VERSION} artisan route:cache
php{SITE_PHP_VERSION} artisan statamic:stache:warm
php{SITE_PHP_VERSION} artisan queue:restart
php{SITE_PHP_VERSION} artisan statamic:search:update --all
php{SITE_PHP_VERSION} artisan statamic:static:clear
php{SITE_PHP_VERSION} artisan statamic:static:warm --queue
php{SITE_PHP_VERSION} artisan statamic:assets:generate-presets --queue

{RELOAD_PHP_FPM}

echo "🚀 Application deployed!"
```

## Deploy script Forge

```bash
if [[ $FORGE_DEPLOY_MESSAGE =~ "[BOT]" ]]; then
    echo "Automatically committed on production. Nothing to deploy."
    exit 0
fi

cd $FORGE_SITE_PATH
git pull origin main
$FORGE_COMPOSER install --no-interaction --prefer-dist --optimize-autoloader --no-dev

npm ci
npm run production
$FORGE_PHP artisan cache:clear
$FORGE_PHP artisan config:cache
$FORGE_PHP artisan route:cache
$FORGE_PHP artisan statamic:stache:warm
$FORGE_PHP artisan queue:restart
$FORGE_PHP artisan statamic:search:update --all
$FORGE_PHP artisan statamic:static:clear
$FORGE_PHP artisan statamic:static:warm --queue
$FORGE_PHP artisan statamic:assets:generate-presets --queue

( flock -w 10 9 || exit 1
    echo 'Restarting FPM...'; sudo -S service $FORGE_PHP_FPM reload ) 9>/tmp/fpmlock
```
