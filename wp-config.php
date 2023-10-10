<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do banco de dados
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do banco de dados - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'biblitech' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'A<*|a,Ohf_)dtluDHp$qPR0lzp^<2Ij8SNmEYL]f.iWsZy|^)hO,Wa#KB]CBb0,=' );
define( 'SECURE_AUTH_KEY',  'fQD&wsk8.9ujHE]&=746`qM{1PyuHY: %Rx}^=:d)Y j+9}]ofh9o`A>6(y*pB=Z' );
define( 'LOGGED_IN_KEY',    '8Nm]>LG z5:|Sg7M7N+~N=@<#3xQ)]!z.V[tXkoe9BWSkQ+Dc^eYquzL+G9(Wn:y' );
define( 'NONCE_KEY',        'i;:o|2KiN}@9dvAM_3+aiZ[5(I`h- G_)E.xYb0LH6ObB4=o=t_?rt,y.G99V5&r' );
define( 'AUTH_SALT',        '-SCJJ`n|zf`8^%-LabDBMYfmH2g-?>}a<HRSD7H1)k))d1o7[T,qk{{36R41@Yd>' );
define( 'SECURE_AUTH_SALT', 'k~4{+<..;(4vA{+ps8RItCtX&a48$)s|R9rU+e~%a/XK@3{rcq/^Q=NNI`Mm^6d.' );
define( 'LOGGED_IN_SALT',   '6<:F2KQZPmyl5k64T/aBAx8V,GC/u`xOF0A-x9?;.s+m*uaOxo1Rl%Aa!x#aR/,4' );
define( 'NONCE_SALT',       '=6zQPP&Pvzpw!k2oNUpebv|M,U%=5r)!y^C7(.xXy1Nu!5/)+S`x0xVu<|yA.!y8' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Adicione valores personalizados entre esta linha até "Isto é tudo". */



/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
