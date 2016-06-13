# Weconstudio Laravel PHP Framework

## Requirements
Create a file named ~/.composer/packages.json containing:
    
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
In your .bash_profile add these lines:

    function weconstudio() {
        HOME_TMP=$(echo ~)
    
        if [ "$1" == "new" ]; then
            composer create-project weconstudio/laravel --repository=${HOME_TMP}/.composer/packages.json $2
        else
            echo "use weconstudio new <project>"
        fi
    }
    
Source your bash profile file or restart your terminal:
    
    source ~/.bash_profile
    
You are ready to create a new project:

    weconstudio new <project>

## Usage with composer

    composer create-project weconstudio/laravel --repository=~/.composer/packages.json <project>
    
## Features

    init database
    migrations
    seed
    npm install
    bower update
    gulp
    git init repository
