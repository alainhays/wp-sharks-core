<?php
/**
 * Fatal error utils.
 *
 * @author @jaswsinc
 * @copyright WebSharks™
 */
declare (strict_types = 1);
namespace WebSharks\WpSharks\Core\Classes\SCore\Utils;

use WebSharks\WpSharks\Core\Classes;
use WebSharks\WpSharks\Core\Interfaces;
use WebSharks\WpSharks\Core\Traits;
#
use WebSharks\Core\WpSharksCore\Classes as CoreClasses;
use WebSharks\Core\WpSharksCore\Classes\Core\Base\Exception;
use WebSharks\Core\WpSharksCore\Interfaces as CoreInterfaces;
use WebSharks\Core\WpSharksCore\Traits as CoreTraits;
#
use function assert as debug;
use function get_defined_vars as vars;

/**
 * Fatal error utils.
 *
 * @since 160524 Fatalities.
 */
class Fatality extends Classes\SCore\Base\Core
{
    /**
     * Invalid.
     *
     * @since 160606 Fatalities.
     *
     * @param string $message Custom message.
     * @param string $slug    Custom error slug.
     */
    public function invalid(string $message = '', string $slug = '')
    {
        if (!$slug) { // Use default?
            $slug = 'invalid';
        }
        if (!$message) { // Use default?
            $message = __('Bad request.', 'wp-sharks-core');
        }
        if ($this->c::isAjax() || $this->c::isApi()) {
            // Via JSON response.
            $this->c::statusHeader(400);
            $this->c::noCacheFlags();
            $this->c::noCacheHeaders();
            header('content-type: application/json; charset=utf-8');

            // Standard JSON response data w/ `success` as `false`.
            exit(json_encode([
                'success' => false,
                'error'   => [
                    'code'    => 400,
                    'slug'    => $slug,
                    'message' => $message,
                ],
            ]));
        }
        wp_die($message, __('Bad request.', 'wp-sharks-core'), ['response' => 400, 'back_link' => true]);
    }

    /**
     * Forbidden.
     *
     * @since 160524 Fatalities.
     *
     * @param string $message Custom message.
     * @param string $slug    Custom error slug.
     */
    public function forbidden(string $message = '', string $slug = '')
    {
        if (!$slug) { // Use default?
            $slug = 'forbidden';
        }
        if (!$message) { // Use default?
            $message = __('Forbidden.', 'wp-sharks-core');
        }
        if ($this->c::isAjax() || $this->c::isApi()) {
            // Via JSON response.
            $this->c::statusHeader(403);
            $this->c::noCacheFlags();
            $this->c::noCacheHeaders();
            header('content-type: application/json; charset=utf-8');

            // Standard JSON response data w/ `success` as `false`.
            exit(json_encode([
                'success' => false,
                'error'   => [
                    'code'    => 403,
                    'slug'    => $slug,
                    'message' => $message,
                ],
            ]));
        }
        wp_die($message, __('Forbidden', 'wp-sharks-core'), ['response' => 403, 'back_link' => true]);
    }
}
