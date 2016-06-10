# Weconstudio Laravel PHP Framework

## Requirements
Create ~/.composer/packages.json like:
    
    {
        "package": {
            "name": "weconstudio/laravel",
            "version": "1.0.0",
            "source": {
              "url": "https://github.com/weconstudio-it/laravel.git",
              "type": "git",
              "reference": "master"
            }
        }
    }

## Usage with weconstudio
In your .bash_profile add this lines:

    function weconstudio() {
        if [ "$1" == "new" ]; then
            composer create-project weconstudio/laravel --repository=/Users/snake/.composer/packages.json $2
        else
            echo "use weconstudio new <project>"
        fi
    }
    
Run:
    
    source ~/.bash_profile
    
You are ready:

    weconstudio new <project>

## Usage with composer

    composer create-project weconstudio/laravel --repository=/Users/snake/.composer/packages.json <project>
    
## Features

    init database
    migrations
    seed
    npm install
    bower update
    gulp
    git init repository