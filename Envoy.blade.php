@setup
    $user = 'klio';
    $timezone = 'Europe/Moscow';

    $path = '/var/www/telegrambot';

    $current = $path . '/current';

    $repo = 'git@github.com:alexeymsa/bomberman.git';

    $branch = 'Bot';

    //$hasHtmlPurifier = true;

    $chmods = [
        'storage/logs',
    ];

    //$symlinks = [
    //'storage/views'    => 'app/storage/views',
    //'storage/sessions' => 'app/storage/sessions',
    //'storage/logs'     => 'app/storage/logs',
    //'storage/cache'    => 'app/storage/cache',
    //];

    $date    = new DateTime('now', new DateTimeZone($timezone));
    $release = $path .'/releases/'. $date->format('YmdHis');

    $on = 'production';
@endsetup

@servers(['production' => $user . '@92.63.106.58'])

@task('clone', ['on' => $on])
    mkdir -p {{ $release }}

    git clone --depth 1 -b {{ $branch }} "{{ $repo }}" {{ $release }}

    echo "Repository has been cloned"
@endtask

@task('composer', ['on' => $on])
    cd {{ $release }}

    composer install --no-interaction --no-dev --prefer-dist

    echo "Composer dependencies have been installed"
@endtask


@task('artisan', ['on' => $on])
    cd {{ $release }}

    ln -nfs {{ $path }}/.env .env;
    chgrp -h www-data .env;

    php artisan config:clear

    php artisan migrate
    php artisan clear-compiled --env=production;
    php artisan optimize --env=production;

    echo "#3 - Production dependencies have been installed"
@endtask



@task('chmod', ['on' => $on])
    chgrp -R www-data {{$release}};
    chmod -R ug+rwx {{$release}};

    @foreach($chmods as $file)
        chmod -R 775 {{ $release }}/{{ $file }}
        chown -R {{$user}}:www-data {{ $release }}/{{ $file }}

        echo "Permissions have been set for {{ $file }}"
    @endforeach

    echo "Permissions for HTMLPurifier have been set"
@endtask

@task('update_symlinks')
    ln -nfs {{ $release }} {{ $current }};
    chgrp -h www-data {{ $current }};

    echo "All symlinks have been set"
@endtask

@macro('deploy', ['on' => 'production'])
    clone
    composer
    artisan
    chmod
    update_symlink
@endmacro
