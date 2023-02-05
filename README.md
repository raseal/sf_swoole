# Installation
Run `make build` in order to install all application dependencies (you must have Docker installed).

For more commands, type `make help`

# Notes
- Ignore the IDE warnings about "constant not found" at `apps/SymfonyClient/public/index.php`
- In order to have this app working without closing, it should have a `supervisor` running on the background
- In order to test the app:
- ```shell
# enter to the container
make shell

# start listening requests
php -d variables_order=EGPCS /app/apps/SymfonyClient/public/index.php

# now go to http://localhost:9001 and you should hit the HelloController
```
