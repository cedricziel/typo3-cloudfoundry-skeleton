# TYPO3 CloudFoundry boilerplate

Delivers a foundation for TYPO3 CMS on any cloudfoundry deployment.

## Walkthrough

1. Open an account with Pivotal CloudFoundry (for example. https://run.pivotal.io)
2. Install the CLI [https://docs.cloudfoundry.org/devguide/installcf/install-go-cli.html]
3. login ``cf login -a https://api.run.pivotal.io -o yourorg -s development -u your@mail -p password``
4. create a mysql-service with ClearDB named ``mysql``
5. run ``cf push``. You should see your app pushed and it will tell you the target URL
6. Open the the URL/typo3 and confirm the last steps of the install tool.
7. Success! :)

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

### On Cloudfoundry

1. Create a ClearDB service named ``mysql`` & set ``TYPO3_SYS_ENCRYPTIONKEY`` in manifest.yml
2. Use ``cf push`` to run the deployment
3. Open the backend at $domain/typo3 and finish the setup - the database credentials will be provided.
4. Once finished, set the environment variables ``TYPO3_SYS_ISINITIALIMPORTDONE`` and ``TYPO3_SYS_ISINITIALINSTALLATIONINPROGRESS``

### On your local machine

1. Install composer
2. Copy ``.env.example`` to ``.env``

## Run locally

``php -S localhost:8000 server.php``

## Reading files on your cloudfoundry instance

As CF has no persistent file storage, you need to read some of them and sync the state.

For example: Install extension, copy the new configuration to your local file.

``cf files $app-name app/web/typo3conf/PackageStates.php``

## Blockers / Criticism

As with most Platform-as-a-Service offerings, Cloud Foundry follows the 12 factor
manifest, which imposes an immutable state of the application to ensure it can scale
up and down and in and out at will.

TYPO3 CMS doesnt offer this state (yet).

Here's a few points:

* official command line interface for, or rather with "admin commands"
* no immutable configuration - it needs to be able to modify its own 
  configuration on install
* temporary storage. While php class caches are volatile, generated images are not

## Proposals

* Allow configuration via environment (no, security is no blocker in that regard. no, it's not overengineering to offer a direct source of configuration)
* Allow for different targets for temporary images and assets - running an app multi-tenant makes local file caches a huge pain
* Take running on public clouds in the easiest ways into account. AppEngine, Pivotal Cloudfoundry, ElasticBeanstalk, Heroku. - They are cheap and can scale fast.

## Applause

So far I'm pretty impressed as to how far the modernizing has gone! Thank you.
