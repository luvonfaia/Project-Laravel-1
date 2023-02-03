### STEP 1: Run ony the app containers (server, php & mysql)
`docker-compose up -d --build server`

### STEP 2: Create a Laravel project using Docker utility (composer)
`docker-compose run --rm composer create-project --prefer-dist laravel/laravel .`

### STEP 3: Drepturi pt storage
`docker exec -it "nume container laravel" bash`
`chmod 0777 -R storage/`

### STEP 4: Run artisan from the utility container (artisan)
`docker-compose run --rm artisan <command>`

### STEP 5: Run npm from the utility container (npm)
`docker-compose run --rm npm <command>`

