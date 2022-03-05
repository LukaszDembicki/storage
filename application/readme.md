<h3>How to run project</h3>
run

```docker-compose up```

then install packages with

```docker exec -i click_php composer install```

project is ready under

```http://localhost:8097```

<h3>Run upload thumbnail command</h3>

* put image you want upload to `var/images` directory
* fill ftp credentials in FTPClient
* run command
    * `docker exec -i click_php bin/console upload-file-as-thumbnail 150 image.jpg ftp`
* to show help
    * `docker exec -i click_php bin/console upload-file-as-thumbnail --help`
