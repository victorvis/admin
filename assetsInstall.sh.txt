#/bin/bash
php app/console assetic:dump --env=prod --no-debug && php app/console cache:clear --env=prod --no-warmup