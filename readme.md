# OpenPub V2

OpenPub is a markdown based blogging system.

The original version of OpenPub was too experimental in the way it
handled everything. This made the code base difficult if not unpleasant
to work with. My goal of OpenPub 2 is to continue developing of an
easy and expendable blogging platform, but to build features that won't
inhibit adoption and future development.


## Up and Running

The goal of open pub is that it should be easy to get it going on your machine.
Below are the steps required to do just that:

### Downloading Source & Basic Setup
```bash
git clone git@github.com:baileylo/openpub.git
composer install
cp .env.example .env
php artisan key:gen
```

### Database
The next steps will configure your database and are specific to the RDMS you 
choose to use. For this example, I'll use sqlite since it's the simplest.

```bash
touch database/database.sqlite
php artisan migrate
```

The rest of the requirements have already been set in your `.env` file.

### Building Your Static Assets

```bash
npm install
gulp
```