<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', '7789.localhost' );

/** Имя пользователя базы данных */
define( 'DB_USER', '7789.localhost' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', '7789.localhost' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '3s*O3|uW|WZ_@*@t{S%>[}Us|`p#9t@7X:-wcr#{R;|mGO<k?7UVu=;E:B:Ityw[' );
define( 'SECURE_AUTH_KEY',  'p: f,-3y-m#(?S;o$,AJZ/)(4&V:EDL<4&+/Vt[^`KI%3@2mV+^29$|m.rXtQLPY' );
define( 'LOGGED_IN_KEY',    'CmCNi*(pdqG^H{n4B{JuZ1fsm;|tJpCk[~3of`LPde9T,z]Z<9`9%[}n:|X)K&Hu' );
define( 'NONCE_KEY',        'k$YA-vgGO_lEAGWf~##zFAJ-8y6Y1sQS41;C}.Y66=);CT2d>>bx6FW9%Is}7V6a' );
define( 'AUTH_SALT',        '.pXc^)-YU+4QMJ!: X%b(vcZXpWsZ>|id,Zw3Cg<_cO9[`?Kfkib,*Vl6)C[6c+U' );
define( 'SECURE_AUTH_SALT', 'czrTg(?JqsGI48kWau,AV~@C*dZv/4i`<y),O]S1(IQ/CLYoPCCCK9|mUW~rGC#f' );
define( 'LOGGED_IN_SALT',   't*MU;A1Qy5^XKXo1Q|)GPNL&EzEDBjajV=JMtN:L8OC-([Xh<3U{7{}r+73m`d4y' );
define( 'NONCE_SALT',       'xT/,BpcfTooZsSy&Zk{GL^<?f}V^>lWNdr~B$R_I1+~[g~&8NqGAgQ|6A1/%/RUc' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
