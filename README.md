[![Yii2](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](https://www.yiiframework.com/)


# Meetup manager

## Description
With this application, you can create pages for your meetups and let your community rate these meetups.

### Features

- See all the meetups and rate for a meetup
- Sort meetups by title/rating
- For admins: Manage meetups (create/delete), users (grant/revoke admin rights, delete), see who rated which meetup

## Getting started

### Prerequisites

What things you need to install the software and how to install them?

- [Composer](https://getcomposer.org/)
- [Docker CE](https://www.docker.com/community-edition)
- [Docker Compose](https://docs.docker.com/compose/install)

### Install

#### Install composer dependencies

```bash
composer install
```

### Init

```bash
docker-compose up -d
```
> Notice: Check the `docker-compose.yml` file content. If other containers use the same ports, change yours.

### Access

You should access to:

- Application: [http://127.0.0.1:80](http://127.0.0.1:80)
- phpMyAdmin: [http://127.0.0.1:8080](http://127.0.0.1:8080)
- MailHog: [http://127.0.0.1:8025](http://127.0.0.1:8025)
> Notice: If you're using Docker Toolbox, change 127.0.0.1 by the IP address of your virtual machine, ie 192.168.99.100

### Fake data

Fake users, meetups and rates are automatically imported when you start docker. If you want to change it, you have to edit the `/sql/import.sql` file.  
You can login as demo users from `demo1@example.com` to `demo11@example.com` with password `demodemo`  
You can login as admin user with `admin@example.com` with password `adminadmin`

## Contributing
Feel free to open issues or pull requests if you want to contribute to this project.
