# OOP Skeleton

## Установка

1. Скопируйте репозиторий командой `git clone https://gitlab.com/resolventa/intership/oop-skeleton.git`

2. Удалите конфигурацию git командой `rm -rf ./.git`

3. Инициализируйте свой репозиторий (REPOSITORY_URL - адрес вашего репозитория github|gitlab):
    ```
    git init
    git add .
    git commit -m 'Add skeleton'
    git remote add origin REPOSITORY_URL
    git branch -M main
    git push -u origin main
    ```

4. Установите необходимые зависимости `composer install`. После установки должно появиться сообщение:

   ```
   Created git hooks folder at: /var/www/oop-skeleton/.git/hooks
   Watch out! GrumPHP is sniffing your commits!
   ```

## Использование снифферов

Снифферы будут автоматически запускаться при каждой фиксации git (git commit) и выводить отчет о проверке. 

Подробнее о снифферах можно почитать [тут](https://github.com/phpro/grumphp) 





