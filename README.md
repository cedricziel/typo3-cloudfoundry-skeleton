# TYPO3 CloudFoundry boilerplate

Delivers a foundation for TYPO3 on any cloud foundry

## Structure

To explain this package a bit, let us quickly run through it:

```
.bp-config/                        # BuildPack configuration

  - options.json                    # Lets you configure webroot, webserver software etc

vendor/                            # composer library directory

web/                               # web root

  - typo3conf/                     # TYPO3 Configuration directory (just a few skeleton files)

    - ENABLE_INSTALL_TOOL          # Just a marker file - use this to enable the install tool manually

    - AdditionalConfiguration.php  # One of the more interesting things dynamic config is nailed here

    - LocalConfiguration.php       # Boilerplate config

    - PackageStates.php            # Important! TYPO3 reads information about active packages from
                                   # this file. If you "install" an extension, you need to

- .cfignore                        # .gitignore style file to exclude files from deployment 

- manifest.yml                     # CloudFoundry manifest [https://docs.cloudfoundry.org/devguide/deploy-apps/manifest.html] 

.env.example                       # Skeleton file. you can set settings from a .env file as well
```

## Configuration

Configuration of the buildpack takes place in [.bp-config/options.json].

For a list of options have a look at [https://github.com/cloudfoundry/php-buildpack/blob/master/docs/config.md].

You can use dotenv to have more 12-factor style configuration ([http://12factor.net/config])


## Composer Github token

To supply the token, you can either use ``cf set-env <your-app-name> COMPOSER_GITHUB_OAUTH_TOKEN "<oauth-token-value>"``, or you can add it to the env: block of your application manifest.

## Installing

1. Create a ClearDB service named ``mysql`` & set ``TYPO3_SYS_ENCRYPTIONKEY`` in manifest.yml
2. Use ``cf push`` to run the deployment
3. Open the backend at $domain/typo3 and finish the setup - the database credentials will be provided.
4. Once finished, set the environment variables ``TYPO3_SYS_ISINITIALIMPORTDONE`` and ``TYPO3_SYS_ISINITIALINSTALLATIONINPROGRESS``

## Run locally

php -S localhost:8000 server.php

## Reading files on your cloudfoundry instance

As CF has no persistent file storage, you need to read some of them and sync the state.

For example: Install extension, copy the new configuration to your local file.

``cf files $app-name app/web/typo3conf/PackageStates.php``
