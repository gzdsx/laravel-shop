<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/oauth/authorize' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.authorizations.authorize',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'passport.authorizations.approve',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'passport.authorizations.deny',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/oauth/token' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.token',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/oauth/tokens' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.tokens.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/oauth/token/refresh' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.token.refresh',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/oauth/clients' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.clients.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'passport.clients.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/oauth/scopes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.scopes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/oauth/personal-access-tokens' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.personal.tokens.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'passport.personal.tokens.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::IQYEFGYYUymXONOb',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/login/appcode' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YI30lbvEdtm2cRZJ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/login/chklogin' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::yFSK3q84VldEtaSR',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'logout',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'register',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::GSTfQjoKil3twXxm',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/reset' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.request',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::SPi3jnJm2F6LzhLc',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/email' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.email',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vPffwzcFxRZmHJoV',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::4DxUTyoUPtFm7WNr',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::UhcMNRG6eWXvVfYH',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fZDTZ9WqTUUzjO1z',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/dashboard.stats' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::K858D02O3nuewoRL',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/dashboard.posts' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::o6AO5Y5ZWpGEZ28v',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/dashboard.newusers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tUtLeVqn9MEUXQz2',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/settings' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9zG9iZB933F80pVM',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Dpd9KAkfxit3iRLY',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/material' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::gzTLI8FxG54Xmi7W',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::XE0gsB85qGVR49ec',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/materials' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::61y2EXF2xfwbQTvY',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/material/upload' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::XmO1wQ18x4RbodgF',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/material/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VCQmurru5V44Vrgd',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/page' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::X4T11HRnPQ5urj58',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::GNZ9oh6weklqD41X',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/pages' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::4fPrgi1B0zFRvoao',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/page/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::l8Q0H4Py0CWbuf8P',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/category' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NH7I6ZyyP4BBXszV',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sf8hwp1NfnZP6RSu',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/categories' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::LJgNkXN67xRUUtUg',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/category/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ly9rpkhTRD2ZTOT1',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/link' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Jbd5KSSsk2wKrxhg',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::eNQYxT0xIAXknIwH',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/links' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9R10C8hMQiDnYAjc',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/link/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::yT1KrfETHm9vaCdi',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/link/categories' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0OFmuWCOGvUClJaG',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/district' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::X62cMCbHD2S5qDhC',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::4B2NBeR1zzcs6XK8',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/districts' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::lCl38GQ0y5QTMw7G',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/district/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sCHFXjWXhSLOCPyl',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/label' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::dvwCpAyLKhUgtlui',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9fHcWHXa6OI8zY1t',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/labels' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OpLlEGsCEsVZZI3k',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/label/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Ec5uGCLIEuJsZnTh',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/label/batch_update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hGYZumbFr30yX56k',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/expresses' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::b6IKhqpeGKxUO0qb',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/express' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Bi3430efZABg8zlF',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/express//delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::POKChUdUM2piFa9u',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/kefus' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::R1mF5dXJtVW4togY',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/kefu' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FVOG1vgbGXrEAcM9',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/kefu/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::wqz4cknCCOF0Xfih',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ad' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qGqVgpQlgCXaf8gh',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::GfYpV0SCiFfeu4oq',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ads' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::zR99lJpbLJlnKniJ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ad/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cNKNYycxBoGV1Yf2',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ad/batch_update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bJAe0BEG2z53rhdj',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/block' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jRza8X2FdFyJER4J',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::8zo0uTMWh4bnGGOn',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/blocks' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hzNYUGsSk4Fh0zCC',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/block/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::DV5LvaKO2BFYl7kE',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/block/item' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::30PIT8VnjKV0UMF8',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/block/item/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9jGZBTOmlcMBy4Ui',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/menus' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bV9ufdtN6zmog9Bs',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/menu' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::auVBd7mUDp41Nm5V',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/menu/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sjCdVKL4sEHY31IG',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/menu/items' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CnnuiH0pT8hKublH',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/menu/item' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QN9nSJbMfMsdaAhf',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/menu/item/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TIFOrO6rA4I5F9lF',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/menu/item/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7pLO8BC00GPHX6sS',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::6tDADuFPw4F1BXg6',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Hmj1hm0mamhFC1OZ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/users' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::08GDPxCoqwwJE6Lh',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/user/info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BYcqxKoUyjEGv1Pc',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/user/groups' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cZaoPtbLnak2YENX',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/user/group' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Ib41rkdjzYAYoouj',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/user/group/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pWTvkYI2rvyAuTP5',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/post' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2mbCweRuKhltU7zW',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::d7fHgcBoxcWSphYm',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/posts' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Qjz6XMYqJdDA4q1O',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/post/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QJNW331OYAyhc72O',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/post/batch_update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Oa1GaNXYkBXijNry',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/trade/order.info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Amwp9QWAXPT4DPLv',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/trade/order.list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::wRuzTpLK1blVsDSv',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/trade/order.send' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Bg2JarTFVYBydXz1',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/trade/order.adjustprice' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PmLvYUk2NyGJ3tuk',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/trade/order.batchDelete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MVTH7zIAp0IFsZBz',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/trade/refund.info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::13PG4YSOLltBmF1U',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/trade/refund.list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FDDGFJut1htAN7zK',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/trade/refund.delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::z56zuNNaAHEwsxt1',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/trade/refund.resolve' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::u8sBxOqRhHh8VeQy',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/trade/refund.reject' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::o2ZD5YDPdFeyV9KF',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/trade/refund.shipping/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7FUzBThn9xBvhEKJ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/trade/refund.reason.list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::lu3Z2O3UMXroL11P',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/trade/refund.reason.save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::o0tWHZIgdO5eXlKJ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/trade/refund.reason.delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9edec6S0FnQuDE33',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/trade/transaction.list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::GXHn6YgvHmiDEcDC',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/trade/transaction.batchdelete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hEpHSNwSVVhcAlpR',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/menu.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::k3FrGjcSVAuJL3U2',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/menu.getTypes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::i7qtHnOytnCvBcVU',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/menu.save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9PghDSJHPNbQoff9',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/menu.delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::36PaEsFHCGlCD0MX',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/menu.apply' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::uogPJBjJxNKiTCjU',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/material.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::zHgoF2kBP35yhNJf',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/material.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qZYH0B2FBolHpXX9',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/material.image' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TWvvF6x2oD1rJZap',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/material.batchDelete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::y5RbpedI4pZHq55t',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Buna2bA5pl2PsdxP',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::1hhURNdnNcrOf6dC',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::GYI9bvwpTWigdikd',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.batchDelete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::aItyYhq6fcJy5pNk',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.batchUpdate' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pYbq93rpkgtQWpFh',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.content.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::o4alUoB0voEY5vzv',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.category.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rp0vkcNNzhEeGSML',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.category.increase' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HO7lhUzWC1I1Okdh',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.category.decrease' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9fwsTr7bfSsXRAgj',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.category.upgrade' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::gTjIlYASChraZOJZ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.category.save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::84Y6NLmnu1vSqQtn',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.category.delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jIjIDOtTDPZvvWND',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.attr.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::gLkjgJHCNpWVujD0',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.attr.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cMZgqMfIiV07RV7y',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.attr.save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pyRXUzOsfICd0G3E',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.attr.delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TfleOn547SenbKZz',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.attr.updateAttrValue' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7pofTSHkCAfRL9OL',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.attrvalue.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vseNTETFeoOFmfMP',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.attrvalue.save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rBNk2NsFfzmo1B1K',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.attrvalue.delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::oeMg1Us4iynq2QtH',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.template.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::y19VAGEDbi0HlcCp',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.template.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::zVESUzIuPMhJq7cb',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.template.save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Ii8hlTikbUnXQ2HZ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/product.template.delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sTVbYLnwWsn8o8bM',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/shop.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::JNHpCVEvLpQx4GQR',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/shop.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NUnfqsc0r8ubT4hq',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/shop.save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::a3L3Tsb52pVGUCv5',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/shop.verify' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::gbqs93W51zu4lSNj',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/shop.batchDelete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ImIo7B2eDtsRMlkK',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/shop.batchUpdate' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jZYer3Yvqbp5Fkzv',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/refund/address/list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YSWYGsHTeSVQTMtv',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/refund/address/save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pVNIeKi9x8frVRP8',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/refund/address/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PPWrPgEjADy6hDHn',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/refund/reason/list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::B0TEnV0KuOFSyasy',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/refund/reason/save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::a3oHZpk0YyWRArbD',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/refund/reason/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MpGMzPPwSnvkAhAr',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/coupon.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BW8SO50HASGdE7cm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/coupon.save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::t8HUAnvWiyqL29Pw',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/coupon.batchDelete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ipBSy5KxnXiZI02R',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ecom/coupon.batchUpdate' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bEf0yclJzz8roNX3',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/lbs/geocoder' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::o5gpb38qAKw3VW4S',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/post' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::naeOSiyQXg6FqVts',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/post/list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::X2kh95vpjJfN73aI',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/shop' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::IPV1EGulueJ8twtp',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kgloWcpruVzIzRoB',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/product/search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::neRn4KLGfYE9Hpt9',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/product/reviews' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::6OQUuhiSs4A5QIWn',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/order/buynow' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::EQzUqjv3ZUcGmtzE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/order/confirm' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::UNz19DEwxRJjzSzj',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/order/pay' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::c1WC7NDhvlr4C5Eb',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/order/pay/result' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::6MRM452WDfitxa6x',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/order/alipay' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kQrLF5TvjXetudLw',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/order/query/alipay' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::x3KhcMVHNManOv8y',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cart' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VaXuiUb9kKPmWIlx',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/live' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::JTQRN7mZ0WKcfLlF',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/video' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cNbM5Wc9F6xzjlFP',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kRotm17BwAp5i6Wb',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WhyfLruNLvUacuPI',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/test' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hLxxOjo4ObWb7eKL',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/app/chatapp' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QozjgNFsqgVDjQ1k',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MUCCaX4oAPrIlMVU',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ver_code_login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::DlC4lmOVj3mmH6Eo',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/miniprogram.session' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::GaoMaWmDeRmCovHz',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/miniprogram.login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::gOpldLdTXmcCFMqi',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/miniprogram.register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ca1ZhYRBuLotWO1p',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/miniprogram.decrypt' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::dcVRH1WVQGs0rKWo',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/miniprogram.phonenumber' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qOKgZvHO57yE2X4V',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/miniprogram.confirm_login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::6yRu8qd28jsGcSv5',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/officialaccount.login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OOqharu50rwvRTU6',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/user.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::t4MGLYMghS6TNagS',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/info.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YVz2d0fRhvz2mg5K',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/info.updateAvatar' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::knBKWRTngxff2QRr',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/info.updateName' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::nYyo6r3QrNpjxat9',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/password.reset' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::H9z6gKzgtIbKb7wi',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/phone.bind' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mZJHJqYRz0TJKQwO',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/email.bind' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Cgw9wzMD8qbrqu40',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Bj27Bv5JEDR9dWSg',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/profile.update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZHkKYLGyBheaS3Nn',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/account' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::uBChq7GfS3htCuxu',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/account.resetpassword' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::42q9OfmXutyhNZi9',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/account.transfer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::oaZnKv5SiedGFQSa',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/bill.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sPjieL66MXhoHT3U',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/bill.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RsKH0cqfgc5Pg824',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/address.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::o3ge48hL65b5GAo6',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/address.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Puom8PGfpkmjdEbU',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/address.create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2uwjxcWGmBBOSJN7',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/address.update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::1ZFm25CBh4ixhNxa',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/address.delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::enFSBB2tdR8Pwlvk',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/address.setDefault' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0btJH42F0ecbZzH4',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/notification' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Xcd5iN08pHl9XqIK',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/readnotification' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PYnOTj1YYjcyLqxk',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/unreadnotification' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::I3oGXwkkp678z8U5',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/notification.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::O2GKl7bcyXsaJ3P2',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/notification.delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::zgbs4yxjJScQlyrP',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/transfer.commonly' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::DC7EQVtLQjaOhxWx',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/transfer.search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::DPu2Kti1AXf97IUg',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/transfer.find' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5fkmii1o8vqR6rtX',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/position.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jDJNTbv404m3aAxi',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/position.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Q2VCGs90LqHdBySM',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/position.create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::EXuObl9jYx2EYagD',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/position.update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::1digCzha12hW7F5E',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/position.delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PP80ndxqSJBHHYXb',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/education.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2lTCe7d01NtztagM',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/education.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rN3rSrZGHRqqa5Dp',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/education.create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::W6cFTiKoKK5ptzLB',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/education.update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mj6plPbvWavHMRor',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/education.delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kGxCmVLnwrUCVAl0',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/job.intention.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OS1fpdt7QM18nZ6j',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/job.intention.create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::GpNxRGPymEUORcWp',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/job.intention.update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::JoEvIVYyF4ISARUA',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/job.intention.delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::B9lb1Jf9KFP6CqUe',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/common/district.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CNzy0QRp52v17WJk',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/common/district.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tMR5ltwY7kgPTuUv',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/common/district.getCityList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::AmwYiE2wFzgo1zK0',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/common/block.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::evDTdS8CIziGSaGk',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/common/block.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::E3tk9RHb0ajgPJYa',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/common/block.item.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hHfVUDUcZ3ZeOdvn',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/common/material.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::IPUcr7Uelq3LBLlI',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/common/material.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::m1XDr5gNFfqDCgGs',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/common/material.upload' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::DHrQ09kJTVPvpwfs',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/common/express.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::keQcpghfqUCTe3Kf',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/common/express.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::wtyIs0jqZVJyrNiL',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/common/menu.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::AZmLCiDDnLGBJg0H',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/common/kefu.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::eJelJzbOUy7YYIAD',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/common/kefu.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::exGbpp7WIjixuwNH',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/common/link.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::otaT9I3acyR2ZFyI',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/common/link.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7X4p1G034o7udTFl',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/common/ad.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::U73BKE9ztaJcC87Q',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/common/ad.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::zvGG8G5tsEHi4TPE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/common/apns/jpush' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Jn6M9ssIyNEDgnZo',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/common/feedback.create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xksyxQyAzDv3iwIZ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/page/page.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MUfabSAEC1cgSAdn',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/page/page.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qcwitslMgjs6ov8I',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/page/category.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::IVhauZI442D9q2HE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/bought.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Nk6MFuooIZJSlqpL',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/bought.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::l5WD6kJdOrWxRoUS',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/bought.notice' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5z7No1H68TxNJxUh',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/bought.cancel' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HGEXZDYEQhgW3XlK',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/bought.confirm' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZkZ9WSbNAGhjGd1z',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/bought.delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::q1hn7I7bEOhSzPxz',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/bought.getTradeList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::11eC9LleCcvVq9s8',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/bought.getTradeDetail' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KvdqQxtCTxOktODH',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/sold/info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qknJTBxYsdzXvRyR',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/sold/list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::L2fHIaTKEUkAVpro',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/sold/adjustprice' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::nVwXiTZWKYT442FB',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/sold/send' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kmMYOkFdhBMFevUO',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/order.pay' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::no0qBbbi3v61utlK',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/refund.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::LewADvV3jQX25NGt',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/refund.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sGyOm68ogdMbi99j',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/refund.apply' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xN9joNlfDSUCymd6',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/refund.create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::8gaEdqZl8emii8zl',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/refund.update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sXzlDkxAGSiHcT32',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/refund.revoke' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::1f66LdCbSYelGfDt',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/refund.delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9n1DTHtzLWgtOOWt',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/refund.send' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::4chKU8FAEpdvRunj',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/refund.getReasonList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MBiK45R26Vkz3GaL',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/refund.getTradeDetail' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::dIIkvpsbITdJyoXl',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/trade/refund.getAddress' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::B5QrQFBWpImguxeR',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/product.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::IIYJ6CFw2pJEvAR0',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/product.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YoYZQAFRonyYcZly',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/product.content.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KBd00uY6RqU9kk2f',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/product.subscribe.create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MHiKJIDZHD8ChNOI',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/product.subscribe.delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qpbohF3aO95aEtCB',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/product.subscribe.toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::y1GXT7ovzvZ41177',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/product.subscribe.query' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jJZHyU6DACWelXQ4',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/product.subscribe.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bKkCVqH6S8Gm2QT5',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/product.category.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::80HluYD8hFRohGSs',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/product.category.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::03wImTxTIL5CHT8k',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/shop.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cgns6Jabt0V2nJnZ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/shop.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::67Ow9kfBbhUZNhHp',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/shop.getShopItemCount' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Nc9IraFW0hTzDbo8',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/shop.subscribe.create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bFTqt0S3P5Et8cHM',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/shop.subscribe.delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cNu42D8F8IZt7B8G',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/shop.subscribe.toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::d576UDgWBgILsoNX',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/shop.subscribe.query' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::AF5f7i2663gYckIj',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/shop.subscribe.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PwgUghGHSsOgHDOS',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/cart.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tqMQUTOHkQBhoJjM',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/cart.create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Q4ZwOxASGdHpCKQZ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/cart.delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fEoO4wfkbAt4BT94',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/cart.updateQuantity' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fP0fnrInv6rYRyzl',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/cart.confirm' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9cFwf1DQS1I8BPhW',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/cart.settlement' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::U0kS6ahqgrt3WDNC',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/order.calculate' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vdhyu1jDyRCf5nSc',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/order.create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VYDGyPuZ5QSegbo7',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ecom/order.close.reasons' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ofDgdH2gbYXn768M',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/post/item.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MWXxDtDpLCOrHZTa',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/post/item.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::o3MLWQdCfY9Ni3oX',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/post/content.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jcc0ZEr7TGwk31Sn',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/post/category.getInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HilTukRxo2afdUye',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/post/category.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7GhfhIooVLysHTor',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/post/subscribe.getList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2KenIgo9sh8SfCzI',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/post/subscribe.toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3oaw3lMbXNJz03lA',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/post/subscribe.delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ww5VkM7fnorInNNA',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/post/subscribe.query' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZrlJLBsvKgM3pIbP',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/live/info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vSR6DCNuZGjmjXUv',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/live/list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xN3WXfIZVPh3JuwM',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/live/channel/info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::GISBUSL6DgUUQsQO',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/live/channel/list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::GXb9Zz4cNJXjXaFy',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/live/ticket' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::k5PCEOnrtJDardzQ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/live/ticket/buy' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YoLy9lwGbXogVaVw',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/video/info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::UWBs1KyHT3tJiNDz',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/video/list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::w05V7o3cQD3ufbEj',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/video/save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qWig9lv74IiUXT5c',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/video/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Z8OhKdvHWDgz7wa9',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/video/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OUaDA10YWptvrlUs',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/video/upload' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QQgWDlg6c43sonhZ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/video/watch' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CrwXeTBOuWXX05z6',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/video/like/check' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::lNrbvhNq2dKScbOm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/video/like/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ABT2sM5D5fv5np4d',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/video/like/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Y1N2zJuLKN3JzHBA',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/video/like/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::LkssdqMcx12ddqfH',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/video/comment/list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Ymev34sfBhsOKd5c',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/video/comment/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::oLbSUhlJZnBrrjgP',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/lbs/geocode.geo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3cvxigpchOmN1H8Q',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/lbs/geocode.regeo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BDEslp1gLxXZVhFY',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/app/getversion' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KBMmtopdXaEZ0Q1k',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/reachable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::50B1KCUOKta70jF9',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/notify/wechat/officalaccount/server' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7RdijqdX6F02b5RW',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/notify/wechat/miniprogram/server' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::I8upfPelJKXKqrSU',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/notify/wechat/recharge' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::isCdPzWf7TaxyPRf',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/notify/wechat/peisong/paid' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9GqqyicPNyCMZ5wi',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/notify/wechat/dache/paid' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::suPwueuTmHftHgl5',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/notify/wechat/vip/paid' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CiHNEgIDGHTuqBRC',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/notify/alipay/order.paid' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2gARGh0Jy2vzzI2e',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/notify/live/on_publish' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::W0VoF2jJGRB7qzjz',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/notify/live/on_publish_done' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rwaHwR53fZ7eeh4k',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/captcha(?|/api(?:/([^/]++))?(*:36)|(?:/([^/]++))?(*:57))|/oauth/(?|tokens/([^/]++)(*:90)|clients/([^/]++)(?|(*:116))|personal\\-access\\-tokens/([^/]++)(*:158))|/p(?|a(?|ssword/reset/([^/]++)(*:197)|ge/([^/\\.]++)\\.html(*:224))|ost/(?|category/([^/]++)(*:257)|([^/\\.]++)\\.html(*:281))|roduct/([^/\\.]++)\\.html(*:313))|/live/([^/]++)(*:336)|/video/([^/\\.]++)\\.html(*:367)|/notify/(?|wechat/order/(?|paid/([^/]++)(*:415)|refund/([^/]++)(*:438))|live/live/paid/([^/]++)(*:470))|/h5/p(?|age/([^/\\.]++)\\.html(*:507)|ost/([^/\\.]++)\\.html(*:535)))/?$}sDu',
    ),
    3 => 
    array (
      36 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qSEoxtm136DJU7qi',
            'config' => NULL,
          ),
          1 => 
          array (
            0 => 'config',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      57 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VSPtuY6rLCLzqeho',
            'config' => NULL,
          ),
          1 => 
          array (
            0 => 'config',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      90 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.tokens.destroy',
          ),
          1 => 
          array (
            0 => 'token_id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      116 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.clients.update',
          ),
          1 => 
          array (
            0 => 'client_id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'passport.clients.destroy',
          ),
          1 => 
          array (
            0 => 'client_id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      158 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.personal.tokens.destroy',
          ),
          1 => 
          array (
            0 => 'token_id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      197 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.reset',
          ),
          1 => 
          array (
            0 => 'token',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      224 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pvx9MRu3jeoE1q9M',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      257 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::O05qnJ1J7YZ4uxnH',
          ),
          1 => 
          array (
            0 => 'catid',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      281 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VuXbCuX2sM3ocwZU',
          ),
          1 => 
          array (
            0 => 'aid',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      313 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mhAgLbJ6IqsmdAcV',
          ),
          1 => 
          array (
            0 => 'itemid',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      336 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pxb63k90Yb2AXQgY',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      367 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qjZBoYHSCtaeOKer',
          ),
          1 => 
          array (
            0 => 'vid',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      415 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qcqpXagnjqfPvNrP',
          ),
          1 => 
          array (
            0 => 'app',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      438 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::weIocIqbLAE30sHv',
          ),
          1 => 
          array (
            0 => 'app',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      470 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cCVg4GFDEtxq1tFB',
          ),
          1 => 
          array (
            0 => 'appid',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      507 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::M4kEYQyyfTU5gETH',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      535 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vVxZJuscD7XtGq5v',
          ),
          1 => 
          array (
            0 => 'aid',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'generated::qSEoxtm136DJU7qi' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'captcha/api/{config?}',
      'action' => 
      array (
        'uses' => '\\Mews\\Captcha\\CaptchaController@getCaptchaApi',
        'controller' => '\\Mews\\Captcha\\CaptchaController@getCaptchaApi',
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'generated::qSEoxtm136DJU7qi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VSPtuY6rLCLzqeho' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'captcha/{config?}',
      'action' => 
      array (
        'uses' => '\\Mews\\Captcha\\CaptchaController@getCaptcha',
        'controller' => '\\Mews\\Captcha\\CaptchaController@getCaptcha',
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'generated::VSPtuY6rLCLzqeho',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.authorizations.authorize' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'oauth/authorize',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\AuthorizationController@authorize',
        'as' => 'passport.authorizations.authorize',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\AuthorizationController@authorize',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.authorizations.approve' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'oauth/authorize',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\ApproveAuthorizationController@approve',
        'as' => 'passport.authorizations.approve',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\ApproveAuthorizationController@approve',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.authorizations.deny' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'oauth/authorize',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\DenyAuthorizationController@deny',
        'as' => 'passport.authorizations.deny',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\DenyAuthorizationController@deny',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.token' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'oauth/token',
      'action' => 
      array (
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\AccessTokenController@issueToken',
        'as' => 'passport.token',
        'middleware' => 'throttle',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\AccessTokenController@issueToken',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.tokens.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'oauth/tokens',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\AuthorizedAccessTokenController@forUser',
        'as' => 'passport.tokens.index',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\AuthorizedAccessTokenController@forUser',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.tokens.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'oauth/tokens/{token_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\AuthorizedAccessTokenController@destroy',
        'as' => 'passport.tokens.destroy',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\AuthorizedAccessTokenController@destroy',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.token.refresh' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'oauth/token/refresh',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\TransientTokenController@refresh',
        'as' => 'passport.token.refresh',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\TransientTokenController@refresh',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.clients.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'oauth/clients',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController@forUser',
        'as' => 'passport.clients.index',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController@forUser',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.clients.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'oauth/clients',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController@store',
        'as' => 'passport.clients.store',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController@store',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.clients.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'oauth/clients/{client_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController@update',
        'as' => 'passport.clients.update',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController@update',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.clients.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'oauth/clients/{client_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController@destroy',
        'as' => 'passport.clients.destroy',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController@destroy',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.scopes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'oauth/scopes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\ScopeController@all',
        'as' => 'passport.scopes.index',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\ScopeController@all',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.personal.tokens.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'oauth/personal-access-tokens',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController@forUser',
        'as' => 'passport.personal.tokens.index',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController@forUser',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.personal.tokens.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'oauth/personal-access-tokens',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController@store',
        'as' => 'passport.personal.tokens.store',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController@store',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.personal.tokens.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'oauth/personal-access-tokens/{token_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController@destroy',
        'as' => 'passport.personal.tokens.destroy',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController@destroy',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@index',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@index',
        'namespace' => 'App\\Http\\Controllers\\Auth',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YI30lbvEdtm2cRZJ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'login/appcode',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@appcode',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@appcode',
        'namespace' => 'App\\Http\\Controllers\\Auth',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::YI30lbvEdtm2cRZJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::yFSK3q84VldEtaSR' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'login/chklogin',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@chklogin',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@chklogin',
        'namespace' => 'App\\Http\\Controllers\\Auth',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::yFSK3q84VldEtaSR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IQYEFGYYUymXONOb' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@login',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@login',
        'namespace' => 'App\\Http\\Controllers\\Auth',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::IQYEFGYYUymXONOb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'logout' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@logout',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@logout',
        'namespace' => 'App\\Http\\Controllers\\Auth',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@index',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@index',
        'namespace' => 'App\\Http\\Controllers\\Auth',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'register',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GSTfQjoKil3twXxm' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@register',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@register',
        'namespace' => 'App\\Http\\Controllers\\Auth',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::GSTfQjoKil3twXxm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.request' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm',
        'namespace' => 'App\\Http\\Controllers\\Auth',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.request',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.email' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/email',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail',
        'controller' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail',
        'namespace' => 'App\\Http\\Controllers\\Auth',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.email',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.reset' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/reset/{token}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm',
        'namespace' => 'App\\Http\\Controllers\\Auth',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.reset',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::SPi3jnJm2F6LzhLc' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset',
        'controller' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset',
        'namespace' => 'App\\Http\\Controllers\\Auth',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::SPi3jnJm2F6LzhLc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vPffwzcFxRZmHJoV' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\IndexController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\IndexController@index',
        'namespace' => 'App\\Http\\Controllers\\Admin',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::vPffwzcFxRZmHJoV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4DxUTyoUPtFm7WNr' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Auth\\LoginController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\Auth\\LoginController@index',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Auth',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::4DxUTyoUPtFm7WNr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::UhcMNRG6eWXvVfYH' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Auth\\LoginController@login',
        'controller' => 'App\\Http\\Controllers\\Admin\\Auth\\LoginController@login',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Auth',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::UhcMNRG6eWXvVfYH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fZDTZ9WqTUUzjO1z' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Auth\\LoginController@logout',
        'controller' => 'App\\Http\\Controllers\\Admin\\Auth\\LoginController@logout',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Auth',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::fZDTZ9WqTUUzjO1z',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::K858D02O3nuewoRL' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dashboard.stats',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\DashboardController@stats',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\DashboardController@stats',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::K858D02O3nuewoRL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::o6AO5Y5ZWpGEZ28v' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dashboard.posts',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\DashboardController@posts',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\DashboardController@posts',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::o6AO5Y5ZWpGEZ28v',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tUtLeVqn9MEUXQz2' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dashboard.newusers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\DashboardController@newusers',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\DashboardController@newusers',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::tUtLeVqn9MEUXQz2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9zG9iZB933F80pVM' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\SettingController@settings',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\SettingController@settings',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::9zG9iZB933F80pVM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Dpd9KAkfxit3iRLY' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\SettingController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\SettingController@update',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::Dpd9KAkfxit3iRLY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::gzTLI8FxG54Xmi7W' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/material',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\MaterialController@material',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\MaterialController@material',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::gzTLI8FxG54Xmi7W',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::61y2EXF2xfwbQTvY' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/materials',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\MaterialController@materials',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\MaterialController@materials',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::61y2EXF2xfwbQTvY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::XE0gsB85qGVR49ec' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/material',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\MaterialController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\MaterialController@update',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::XE0gsB85qGVR49ec',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::XmO1wQ18x4RbodgF' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/material/upload',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\MaterialController@upload',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\MaterialController@upload',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::XmO1wQ18x4RbodgF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VCQmurru5V44Vrgd' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/material/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\MaterialController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\MaterialController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::VCQmurru5V44Vrgd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::X4T11HRnPQ5urj58' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/page',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\PageController@page',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\PageController@page',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::X4T11HRnPQ5urj58',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4fPrgi1B0zFRvoao' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/pages',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\PageController@pages',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\PageController@pages',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::4fPrgi1B0zFRvoao',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GNZ9oh6weklqD41X' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/page',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\PageController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\PageController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::GNZ9oh6weklqD41X',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::l8Q0H4Py0CWbuf8P' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/page/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\PageController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\PageController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::l8Q0H4Py0CWbuf8P',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NH7I6ZyyP4BBXszV' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/category',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\CategoryController@category',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\CategoryController@category',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::NH7I6ZyyP4BBXszV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::LJgNkXN67xRUUtUg' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\CategoryController@categories',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\CategoryController@categories',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::LJgNkXN67xRUUtUg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sf8hwp1NfnZP6RSu' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/category',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\CategoryController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\CategoryController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::sf8hwp1NfnZP6RSu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ly9rpkhTRD2ZTOT1' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/category/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\CategoryController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\CategoryController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::ly9rpkhTRD2ZTOT1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Jbd5KSSsk2wKrxhg' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/link',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\LinkController@link',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\LinkController@link',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::Jbd5KSSsk2wKrxhg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9R10C8hMQiDnYAjc' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/links',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\LinkController@links',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\LinkController@links',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::9R10C8hMQiDnYAjc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::eNQYxT0xIAXknIwH' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/link',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\LinkController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\LinkController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::eNQYxT0xIAXknIwH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::yT1KrfETHm9vaCdi' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/link/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\LinkController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\LinkController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::yT1KrfETHm9vaCdi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0OFmuWCOGvUClJaG' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/link/categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\LinkController@categories',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\LinkController@categories',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::0OFmuWCOGvUClJaG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::X62cMCbHD2S5qDhC' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/district',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\DistrcitController@district',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\DistrcitController@district',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::X62cMCbHD2S5qDhC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::lCl38GQ0y5QTMw7G' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/districts',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\DistrcitController@districts',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\DistrcitController@districts',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::lCl38GQ0y5QTMw7G',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4B2NBeR1zzcs6XK8' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/district',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\DistrcitController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\DistrcitController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::4B2NBeR1zzcs6XK8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sCHFXjWXhSLOCPyl' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/district/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\DistrcitController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\DistrcitController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::sCHFXjWXhSLOCPyl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::dvwCpAyLKhUgtlui' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/label',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\LabelController@label',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\LabelController@label',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::dvwCpAyLKhUgtlui',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OpLlEGsCEsVZZI3k' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/labels',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\LabelController@labels',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\LabelController@labels',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::OpLlEGsCEsVZZI3k',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9fHcWHXa6OI8zY1t' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/label',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\LabelController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\LabelController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::9fHcWHXa6OI8zY1t',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Ec5uGCLIEuJsZnTh' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/label/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\LabelController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\LabelController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::Ec5uGCLIEuJsZnTh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hGYZumbFr30yX56k' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/label/batch_update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\LabelController@batchUpdate',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\LabelController@batchUpdate',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::hGYZumbFr30yX56k',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::b6IKhqpeGKxUO0qb' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/expresses',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\ExpressController@expresses',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\ExpressController@expresses',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::b6IKhqpeGKxUO0qb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Bi3430efZABg8zlF' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/express',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\ExpressController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\ExpressController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::Bi3430efZABg8zlF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::POKChUdUM2piFa9u' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/express//delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\ExpressController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\ExpressController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::POKChUdUM2piFa9u',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::R1mF5dXJtVW4togY' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/kefus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\KefuController@kefus',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\KefuController@kefus',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::R1mF5dXJtVW4togY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FVOG1vgbGXrEAcM9' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/kefu',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\KefuController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\KefuController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::FVOG1vgbGXrEAcM9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wqz4cknCCOF0Xfih' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/kefu/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\KefuController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\KefuController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::wqz4cknCCOF0Xfih',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qGqVgpQlgCXaf8gh' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ad',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\AdController@ad',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\AdController@ad',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::qGqVgpQlgCXaf8gh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::zR99lJpbLJlnKniJ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ads',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\AdController@ads',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\AdController@ads',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::zR99lJpbLJlnKniJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GfYpV0SCiFfeu4oq' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ad',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\AdController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\AdController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::GfYpV0SCiFfeu4oq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cNKNYycxBoGV1Yf2' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ad/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\AdController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\AdController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::cNKNYycxBoGV1Yf2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bJAe0BEG2z53rhdj' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ad/batch_update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\AdController@batchUpdate',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\AdController@batchUpdate',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::bJAe0BEG2z53rhdj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jRza8X2FdFyJER4J' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/block',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\BlockController@block',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\BlockController@block',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::jRza8X2FdFyJER4J',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hzNYUGsSk4Fh0zCC' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/blocks',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\BlockController@blocks',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\BlockController@blocks',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::hzNYUGsSk4Fh0zCC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8zo0uTMWh4bnGGOn' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/block',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\BlockController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\BlockController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::8zo0uTMWh4bnGGOn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::DV5LvaKO2BFYl7kE' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/block/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\BlockController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\BlockController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::DV5LvaKO2BFYl7kE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::30PIT8VnjKV0UMF8' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/block/item',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\BlockItemController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\BlockItemController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::30PIT8VnjKV0UMF8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9jGZBTOmlcMBy4Ui' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/block/item/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\BlockItemController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\BlockItemController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::9jGZBTOmlcMBy4Ui',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bV9ufdtN6zmog9Bs' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/menus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\MenuController@menus',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\MenuController@menus',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::bV9ufdtN6zmog9Bs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::auVBd7mUDp41Nm5V' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/menu',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\MenuController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\MenuController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::auVBd7mUDp41Nm5V',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sjCdVKL4sEHY31IG' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/menu/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\MenuController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\MenuController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::sjCdVKL4sEHY31IG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CnnuiH0pT8hKublH' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/menu/items',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\MenuItemController@items',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\MenuItemController@items',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::CnnuiH0pT8hKublH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QN9nSJbMfMsdaAhf' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/menu/item',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\MenuItemController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\MenuItemController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::QN9nSJbMfMsdaAhf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TIFOrO6rA4I5F9lF' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/menu/item/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\MenuItemController@toggle',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\MenuItemController@toggle',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::TIFOrO6rA4I5F9lF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7pLO8BC00GPHX6sS' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/menu/item/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Common\\MenuItemController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Common\\MenuItemController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Common',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::7pLO8BC00GPHX6sS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::6tDADuFPw4F1BXg6' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\User\\UserController@user',
        'controller' => 'App\\Http\\Controllers\\Admin\\User\\UserController@user',
        'namespace' => 'App\\Http\\Controllers\\Admin\\User',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::6tDADuFPw4F1BXg6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::08GDPxCoqwwJE6Lh' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\User\\UserController@users',
        'controller' => 'App\\Http\\Controllers\\Admin\\User\\UserController@users',
        'namespace' => 'App\\Http\\Controllers\\Admin\\User',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::08GDPxCoqwwJE6Lh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Hmj1hm0mamhFC1OZ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\User\\UserController@user',
        'controller' => 'App\\Http\\Controllers\\Admin\\User\\UserController@user',
        'namespace' => 'App\\Http\\Controllers\\Admin\\User',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::Hmj1hm0mamhFC1OZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BYcqxKoUyjEGv1Pc' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/user/info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\User\\UserController@info',
        'controller' => 'App\\Http\\Controllers\\Admin\\User\\UserController@info',
        'namespace' => 'App\\Http\\Controllers\\Admin\\User',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::BYcqxKoUyjEGv1Pc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cZaoPtbLnak2YENX' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/user/groups',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\User\\GroupController@groups',
        'controller' => 'App\\Http\\Controllers\\Admin\\User\\GroupController@groups',
        'namespace' => 'App\\Http\\Controllers\\Admin\\User',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::cZaoPtbLnak2YENX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Ib41rkdjzYAYoouj' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/user/group',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\User\\GroupController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\User\\GroupController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\User',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::Ib41rkdjzYAYoouj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pWTvkYI2rvyAuTP5' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/user/group/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\User\\GroupController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\User\\GroupController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\User',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::pWTvkYI2rvyAuTP5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2mbCweRuKhltU7zW' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/post',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Post\\PostController@post',
        'controller' => 'App\\Http\\Controllers\\Admin\\Post\\PostController@post',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Post',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::2mbCweRuKhltU7zW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Qjz6XMYqJdDA4q1O' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/posts',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Post\\PostController@posts',
        'controller' => 'App\\Http\\Controllers\\Admin\\Post\\PostController@posts',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Post',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::Qjz6XMYqJdDA4q1O',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::d7fHgcBoxcWSphYm' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/post',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Post\\PostController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Post\\PostController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Post',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::d7fHgcBoxcWSphYm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QJNW331OYAyhc72O' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/post/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Post\\PostController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Post\\PostController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Post',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::QJNW331OYAyhc72O',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Oa1GaNXYkBXijNry' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/post/batch_update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Post\\PostController@batchUpdate',
        'controller' => 'App\\Http\\Controllers\\Admin\\Post\\PostController@batchUpdate',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Post',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::Oa1GaNXYkBXijNry',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Amwp9QWAXPT4DPLv' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/trade/order.info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Trade\\OrderController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Admin\\Trade\\OrderController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Trade',
        'prefix' => 'admin/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::Amwp9QWAXPT4DPLv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wRuzTpLK1blVsDSv' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/trade/order.list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Trade\\OrderController@getList',
        'controller' => 'App\\Http\\Controllers\\Admin\\Trade\\OrderController@getList',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Trade',
        'prefix' => 'admin/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::wRuzTpLK1blVsDSv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Bg2JarTFVYBydXz1' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/trade/order.send',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Trade\\OrderController@send',
        'controller' => 'App\\Http\\Controllers\\Admin\\Trade\\OrderController@send',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Trade',
        'prefix' => 'admin/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::Bg2JarTFVYBydXz1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PmLvYUk2NyGJ3tuk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/trade/order.adjustprice',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Trade\\OrderController@adjustPrice',
        'controller' => 'App\\Http\\Controllers\\Admin\\Trade\\OrderController@adjustPrice',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Trade',
        'prefix' => 'admin/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::PmLvYUk2NyGJ3tuk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MVTH7zIAp0IFsZBz' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/trade/order.batchDelete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Trade\\OrderController@batchDelete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Trade\\OrderController@batchDelete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Trade',
        'prefix' => 'admin/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::MVTH7zIAp0IFsZBz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::13PG4YSOLltBmF1U' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/trade/refund.info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Trade\\RefundController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Admin\\Trade\\RefundController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Trade',
        'prefix' => 'admin/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::13PG4YSOLltBmF1U',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FDDGFJut1htAN7zK' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/trade/refund.list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Trade\\RefundController@getList',
        'controller' => 'App\\Http\\Controllers\\Admin\\Trade\\RefundController@getList',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Trade',
        'prefix' => 'admin/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::FDDGFJut1htAN7zK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::z56zuNNaAHEwsxt1' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/trade/refund.delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Trade\\RefundController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Trade\\RefundController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Trade',
        'prefix' => 'admin/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::z56zuNNaAHEwsxt1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::u8sBxOqRhHh8VeQy' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/trade/refund.resolve',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Trade\\RefundController@resolve',
        'controller' => 'App\\Http\\Controllers\\Admin\\Trade\\RefundController@resolve',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Trade',
        'prefix' => 'admin/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::u8sBxOqRhHh8VeQy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::o2ZD5YDPdFeyV9KF' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/trade/refund.reject',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Trade\\RefundController@reject',
        'controller' => 'App\\Http\\Controllers\\Admin\\Trade\\RefundController@reject',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Trade',
        'prefix' => 'admin/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::o2ZD5YDPdFeyV9KF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7FUzBThn9xBvhEKJ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/trade/refund.shipping/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Trade\\RefundController@updateShipping',
        'controller' => 'App\\Http\\Controllers\\Admin\\Trade\\RefundController@updateShipping',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Trade',
        'prefix' => 'admin/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::7FUzBThn9xBvhEKJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::lu3Z2O3UMXroL11P' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/trade/refund.reason.list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Trade\\RefundReasonController@getList',
        'controller' => 'App\\Http\\Controllers\\Admin\\Trade\\RefundReasonController@getList',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Trade',
        'prefix' => 'admin/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::lu3Z2O3UMXroL11P',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::o0tWHZIgdO5eXlKJ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/trade/refund.reason.save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Trade\\RefundReasonController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Trade\\RefundReasonController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Trade',
        'prefix' => 'admin/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::o0tWHZIgdO5eXlKJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9edec6S0FnQuDE33' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/trade/refund.reason.delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Trade\\RefundReasonController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Trade\\RefundReasonController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Trade',
        'prefix' => 'admin/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::9edec6S0FnQuDE33',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GXHn6YgvHmiDEcDC' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/trade/transaction.list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Trade\\TransactionController@getList',
        'controller' => 'App\\Http\\Controllers\\Admin\\Trade\\TransactionController@getList',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Trade',
        'prefix' => 'admin/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::GXHn6YgvHmiDEcDC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hEpHSNwSVVhcAlpR' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/trade/transaction.batchdelete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Trade\\TransactionController@batchDelete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Trade\\TransactionController@batchDelete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Trade',
        'prefix' => 'admin/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::hEpHSNwSVVhcAlpR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::k3FrGjcSVAuJL3U2' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/menu.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Wechat\\MenuController@getList',
        'controller' => 'App\\Http\\Controllers\\Admin\\Wechat\\MenuController@getList',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Wechat',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::k3FrGjcSVAuJL3U2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::i7qtHnOytnCvBcVU' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/menu.getTypes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Wechat\\MenuController@getTypes',
        'controller' => 'App\\Http\\Controllers\\Admin\\Wechat\\MenuController@getTypes',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Wechat',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::i7qtHnOytnCvBcVU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9PghDSJHPNbQoff9' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/menu.save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Wechat\\MenuController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Wechat\\MenuController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Wechat',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::9PghDSJHPNbQoff9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::36PaEsFHCGlCD0MX' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/menu.delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Wechat\\MenuController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Wechat\\MenuController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Wechat',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::36PaEsFHCGlCD0MX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::uogPJBjJxNKiTCjU' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/menu.apply',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Wechat\\MenuController@apply',
        'controller' => 'App\\Http\\Controllers\\Admin\\Wechat\\MenuController@apply',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Wechat',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::uogPJBjJxNKiTCjU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::zHgoF2kBP35yhNJf' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/material.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Wechat\\MaterialController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Admin\\Wechat\\MaterialController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Wechat',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::zHgoF2kBP35yhNJf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qZYH0B2FBolHpXX9' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/material.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Wechat\\MaterialController@getList',
        'controller' => 'App\\Http\\Controllers\\Admin\\Wechat\\MaterialController@getList',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Wechat',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::qZYH0B2FBolHpXX9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TWvvF6x2oD1rJZap' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/material.image',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Wechat\\MaterialController@image',
        'controller' => 'App\\Http\\Controllers\\Admin\\Wechat\\MaterialController@image',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Wechat',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::TWvvF6x2oD1rJZap',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::y5RbpedI4pZHq55t' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/material.batchDelete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Wechat\\MaterialController@batchDelete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Wechat\\MaterialController@batchDelete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Wechat',
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::y5RbpedI4pZHq55t',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Buna2bA5pl2PsdxP' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ecom/product.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductItemController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductItemController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::Buna2bA5pl2PsdxP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::1hhURNdnNcrOf6dC' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ecom/product.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductItemController@getList',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductItemController@getList',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::1hhURNdnNcrOf6dC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GYI9bvwpTWigdikd' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/product.save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductItemController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductItemController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::GYI9bvwpTWigdikd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::aItyYhq6fcJy5pNk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/product.batchDelete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductItemController@batchDelete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductItemController@batchDelete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::aItyYhq6fcJy5pNk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pYbq93rpkgtQWpFh' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/product.batchUpdate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductItemController@batchUpdate',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductItemController@batchUpdate',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::pYbq93rpkgtQWpFh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::o4alUoB0voEY5vzv' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ecom/product.content.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductContentController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductContentController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::o4alUoB0voEY5vzv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rp0vkcNNzhEeGSML' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ecom/product.category.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductCategoryController@getList',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductCategoryController@getList',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::rp0vkcNNzhEeGSML',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::HO7lhUzWC1I1Okdh' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/product.category.increase',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductCategoryController@increase',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductCategoryController@increase',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::HO7lhUzWC1I1Okdh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9fwsTr7bfSsXRAgj' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/product.category.decrease',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductCategoryController@decrease',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductCategoryController@decrease',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::9fwsTr7bfSsXRAgj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::gTjIlYASChraZOJZ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/product.category.upgrade',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductCategoryController@upgrade',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductCategoryController@upgrade',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::gTjIlYASChraZOJZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::84Y6NLmnu1vSqQtn' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/product.category.save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductCategoryController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductCategoryController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::84Y6NLmnu1vSqQtn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jIjIDOtTDPZvvWND' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/product.category.delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductCategoryController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductCategoryController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::jIjIDOtTDPZvvWND',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::gLkjgJHCNpWVujD0' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ecom/product.attr.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductAttrController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductAttrController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::gLkjgJHCNpWVujD0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cMZgqMfIiV07RV7y' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ecom/product.attr.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductAttrController@getList',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductAttrController@getList',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::cMZgqMfIiV07RV7y',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pyRXUzOsfICd0G3E' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/product.attr.save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductAttrController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductAttrController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::pyRXUzOsfICd0G3E',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TfleOn547SenbKZz' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/product.attr.delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductAttrController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductAttrController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::TfleOn547SenbKZz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7pofTSHkCAfRL9OL' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/product.attr.updateAttrValue',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductAttrController@updateAttrValue',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductAttrController@updateAttrValue',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::7pofTSHkCAfRL9OL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vseNTETFeoOFmfMP' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ecom/product.attrvalue.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductAttrValueController@getList',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductAttrValueController@getList',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::vseNTETFeoOFmfMP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rBNk2NsFfzmo1B1K' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/product.attrvalue.save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductAttrValueController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductAttrValueController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::rBNk2NsFfzmo1B1K',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::oeMg1Us4iynq2QtH' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/product.attrvalue.delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductAttrValueController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductAttrValueController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::oeMg1Us4iynq2QtH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::y19VAGEDbi0HlcCp' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ecom/product.template.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductTemplateController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductTemplateController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::y19VAGEDbi0HlcCp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::zVESUzIuPMhJq7cb' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ecom/product.template.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductTemplateController@getList',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductTemplateController@getList',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::zVESUzIuPMhJq7cb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Ii8hlTikbUnXQ2HZ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/product.template.save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductTemplateController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductTemplateController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::Ii8hlTikbUnXQ2HZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sTVbYLnwWsn8o8bM' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/product.template.delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductTemplateController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ProductTemplateController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::sTVbYLnwWsn8o8bM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::JNHpCVEvLpQx4GQR' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ecom/shop.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ShopController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ShopController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::JNHpCVEvLpQx4GQR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NUnfqsc0r8ubT4hq' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ecom/shop.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ShopController@getList',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ShopController@getList',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::NUnfqsc0r8ubT4hq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::a3L3Tsb52pVGUCv5' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/shop.save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ShopController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ShopController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::a3L3Tsb52pVGUCv5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::gbqs93W51zu4lSNj' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/shop.verify',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ShopController@verify',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ShopController@verify',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::gbqs93W51zu4lSNj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ImIo7B2eDtsRMlkK' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/shop.batchDelete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ShopController@batchDelete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ShopController@batchDelete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::ImIo7B2eDtsRMlkK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jZYer3Yvqbp5Fkzv' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/shop.batchUpdate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\ShopController@batchUpdate',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\ShopController@batchUpdate',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::jZYer3Yvqbp5Fkzv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YSWYGsHTeSVQTMtv' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ecom/refund/address/list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\RefundAddressController@getList',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\RefundAddressController@getList',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::YSWYGsHTeSVQTMtv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pVNIeKi9x8frVRP8' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/refund/address/save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\RefundAddressController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\RefundAddressController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::pVNIeKi9x8frVRP8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PPWrPgEjADy6hDHn' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/refund/address/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\RefundAddressController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\RefundAddressController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::PPWrPgEjADy6hDHn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::B0TEnV0KuOFSyasy' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ecom/refund/reason/list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\RefundReasonController@getList',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\RefundReasonController@getList',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::B0TEnV0KuOFSyasy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::a3oHZpk0YyWRArbD' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/refund/reason/save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\RefundReasonController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\RefundReasonController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::a3oHZpk0YyWRArbD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MpGMzPPwSnvkAhAr' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/refund/reason/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\RefundReasonController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\RefundReasonController@delete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::MpGMzPPwSnvkAhAr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BW8SO50HASGdE7cm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ecom/coupon.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\CouponController@getList',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\CouponController@getList',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::BW8SO50HASGdE7cm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::t8HUAnvWiyqL29Pw' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/coupon.save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\CouponController@save',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\CouponController@save',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::t8HUAnvWiyqL29Pw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ipBSy5KxnXiZI02R' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/coupon.batchDelete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\CouponController@batchDelete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\CouponController@batchDelete',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::ipBSy5KxnXiZI02R',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bEf0yclJzz8roNX3' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ecom/coupon.batchUpdate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Ecom\\CouponController@batchUpdate',
        'controller' => 'App\\Http\\Controllers\\Admin\\Ecom\\CouponController@batchUpdate',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Ecom',
        'prefix' => 'admin/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::bEf0yclJzz8roNX3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::o5gpb38qAKw3VW4S' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/lbs/geocoder',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Lbs\\LbsController@geocoder',
        'controller' => 'App\\Http\\Controllers\\Admin\\Lbs\\LbsController@geocoder',
        'namespace' => 'App\\Http\\Controllers\\Admin\\Lbs',
        'prefix' => 'admin/lbs',
        'where' => 
        array (
        ),
        'as' => 'generated::o5gpb38qAKw3VW4S',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::naeOSiyQXg6FqVts' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'post',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Post\\IndexController@index',
        'controller' => 'App\\Http\\Controllers\\Post\\IndexController@index',
        'namespace' => 'App\\Http\\Controllers\\Post',
        'prefix' => '/post',
        'where' => 
        array (
        ),
        'as' => 'generated::naeOSiyQXg6FqVts',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::O05qnJ1J7YZ4uxnH' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'post/category/{catid}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Post\\IndexController@showPosts',
        'controller' => 'App\\Http\\Controllers\\Post\\IndexController@showPosts',
        'namespace' => 'App\\Http\\Controllers\\Post',
        'prefix' => '/post',
        'where' => 
        array (
        ),
        'as' => 'generated::O05qnJ1J7YZ4uxnH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::X2kh95vpjJfN73aI' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'post/list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Post\\PostController@showPosts',
        'controller' => 'App\\Http\\Controllers\\Post\\PostController@showPosts',
        'namespace' => 'App\\Http\\Controllers\\Post',
        'prefix' => '/post',
        'where' => 
        array (
        ),
        'as' => 'generated::X2kh95vpjJfN73aI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VuXbCuX2sM3ocwZU' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'post/{aid}.html',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Post\\PostController@detail',
        'controller' => 'App\\Http\\Controllers\\Post\\PostController@detail',
        'namespace' => 'App\\Http\\Controllers\\Post',
        'prefix' => '/post',
        'where' => 
        array (
        ),
        'as' => 'generated::VuXbCuX2sM3ocwZU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IPV1EGulueJ8twtp' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'shop',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Ecom\\IndexController@index',
        'controller' => 'App\\Http\\Controllers\\Ecom\\IndexController@index',
        'namespace' => 'App\\Http\\Controllers\\Ecom',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::IPV1EGulueJ8twtp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kgloWcpruVzIzRoB' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Ecom\\ProductController@search',
        'controller' => 'App\\Http\\Controllers\\Ecom\\ProductController@search',
        'namespace' => 'App\\Http\\Controllers\\Ecom',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::kgloWcpruVzIzRoB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::neRn4KLGfYE9Hpt9' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'product/search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Ecom\\ProductController@search',
        'controller' => 'App\\Http\\Controllers\\Ecom\\ProductController@search',
        'namespace' => 'App\\Http\\Controllers\\Ecom',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::neRn4KLGfYE9Hpt9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::6OQUuhiSs4A5QIWn' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'product/reviews',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Ecom\\ProductController@reviews',
        'controller' => 'App\\Http\\Controllers\\Ecom\\ProductController@reviews',
        'namespace' => 'App\\Http\\Controllers\\Ecom',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::6OQUuhiSs4A5QIWn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mhAgLbJ6IqsmdAcV' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'product/{itemid}.html',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Ecom\\ProductController@detail',
        'controller' => 'App\\Http\\Controllers\\Ecom\\ProductController@detail',
        'namespace' => 'App\\Http\\Controllers\\Ecom',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::mhAgLbJ6IqsmdAcV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::EQzUqjv3ZUcGmtzE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => 'order/buynow',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Ecom\\OrderController@buynow',
        'controller' => 'App\\Http\\Controllers\\Ecom\\OrderController@buynow',
        'namespace' => 'App\\Http\\Controllers\\Ecom',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::EQzUqjv3ZUcGmtzE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::UNz19DEwxRJjzSzj' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => 'order/confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Ecom\\OrderController@confirm',
        'controller' => 'App\\Http\\Controllers\\Ecom\\OrderController@confirm',
        'namespace' => 'App\\Http\\Controllers\\Ecom',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::UNz19DEwxRJjzSzj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::c1WC7NDhvlr4C5Eb' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'order/pay',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Ecom\\OrderController@pay',
        'controller' => 'App\\Http\\Controllers\\Ecom\\OrderController@pay',
        'namespace' => 'App\\Http\\Controllers\\Ecom',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::c1WC7NDhvlr4C5Eb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::6MRM452WDfitxa6x' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'order/pay/result',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Ecom\\OrderController@payResult',
        'controller' => 'App\\Http\\Controllers\\Ecom\\OrderController@payResult',
        'namespace' => 'App\\Http\\Controllers\\Ecom',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::6MRM452WDfitxa6x',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kQrLF5TvjXetudLw' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'order/alipay',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Ecom\\OrderController@alipay',
        'controller' => 'App\\Http\\Controllers\\Ecom\\OrderController@alipay',
        'namespace' => 'App\\Http\\Controllers\\Ecom',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::kQrLF5TvjXetudLw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::x3KhcMVHNManOv8y' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'order/query/alipay',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Ecom\\OrderController@alipayQuery',
        'controller' => 'App\\Http\\Controllers\\Ecom\\OrderController@alipayQuery',
        'namespace' => 'App\\Http\\Controllers\\Ecom',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::x3KhcMVHNManOv8y',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VaXuiUb9kKPmWIlx' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'cart',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Ecom\\CartController@index',
        'controller' => 'App\\Http\\Controllers\\Ecom\\CartController@index',
        'namespace' => 'App\\Http\\Controllers\\Ecom',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::VaXuiUb9kKPmWIlx',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::JTQRN7mZ0WKcfLlF' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'live',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Live\\IndexController@index',
        'controller' => 'App\\Http\\Controllers\\Live\\IndexController@index',
        'namespace' => 'App\\Http\\Controllers\\Live',
        'prefix' => '/live',
        'where' => 
        array (
        ),
        'as' => 'generated::JTQRN7mZ0WKcfLlF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pxb63k90Yb2AXQgY' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'live/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Live\\IndexController@detail',
        'controller' => 'App\\Http\\Controllers\\Live\\IndexController@detail',
        'namespace' => 'App\\Http\\Controllers\\Live',
        'prefix' => '/live',
        'where' => 
        array (
        ),
        'as' => 'generated::pxb63k90Yb2AXQgY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cNbM5Wc9F6xzjlFP' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'video',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Video\\IndexController@index',
        'controller' => 'App\\Http\\Controllers\\Video\\IndexController@index',
        'namespace' => 'App\\Http\\Controllers\\Video',
        'prefix' => '/video',
        'where' => 
        array (
        ),
        'as' => 'generated::cNbM5Wc9F6xzjlFP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qjZBoYHSCtaeOKer' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'video/{vid}.html',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Video\\IndexController@detail',
        'controller' => 'App\\Http\\Controllers\\Video\\IndexController@detail',
        'namespace' => 'App\\Http\\Controllers\\Video',
        'prefix' => '/video',
        'where' => 
        array (
        ),
        'as' => 'generated::qjZBoYHSCtaeOKer',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kRotm17BwAp5i6Wb' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Ecom\\IndexController@index',
        'controller' => 'App\\Http\\Controllers\\Ecom\\IndexController@index',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::kRotm17BwAp5i6Wb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pvx9MRu3jeoE1q9M' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'page/{id}.html',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Page\\IndexController@detail',
        'controller' => 'App\\Http\\Controllers\\Page\\IndexController@detail',
        'namespace' => 'App\\Http\\Controllers\\Page',
        'prefix' => '/page',
        'where' => 
        array (
        ),
        'as' => 'generated::pvx9MRu3jeoE1q9M',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::WhyfLruNLvUacuPI' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\User\\IndexController@index',
        'controller' => 'App\\Http\\Controllers\\User\\IndexController@index',
        'namespace' => 'App\\Http\\Controllers\\User',
        'prefix' => '/user',
        'where' => 
        array (
        ),
        'as' => 'generated::WhyfLruNLvUacuPI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hLxxOjo4ObWb7eKL' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\TestController@index',
        'controller' => 'App\\Http\\Controllers\\Web\\TestController@index',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::hLxxOjo4ObWb7eKL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QozjgNFsqgVDjQ1k' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'app/chatapp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Test\\IndexController@chatapp',
        'controller' => 'App\\Http\\Controllers\\Test\\IndexController@chatapp',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::QozjgNFsqgVDjQ1k',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MUCCaX4oAPrIlMVU' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\OAuth\\RegisterController@register',
        'controller' => 'App\\Http\\Controllers\\Api\\OAuth\\RegisterController@register',
        'namespace' => 'App\\Http\\Controllers\\Api\\OAuth',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::MUCCaX4oAPrIlMVU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::DlC4lmOVj3mmH6Eo' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/ver_code_login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\OAuth\\LoginController@verCodeLogin',
        'controller' => 'App\\Http\\Controllers\\Api\\OAuth\\LoginController@verCodeLogin',
        'namespace' => 'App\\Http\\Controllers\\Api\\OAuth',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::DlC4lmOVj3mmH6Eo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GaoMaWmDeRmCovHz' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/miniprogram.session',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\MiniProgramController@session',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\MiniProgramController@session',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::GaoMaWmDeRmCovHz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::gOpldLdTXmcCFMqi' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/miniprogram.login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\MiniProgramController@login',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\MiniProgramController@login',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::gOpldLdTXmcCFMqi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ca1ZhYRBuLotWO1p' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/miniprogram.register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\MiniProgramController@register',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\MiniProgramController@register',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::ca1ZhYRBuLotWO1p',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::dcVRH1WVQGs0rKWo' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/miniprogram.decrypt',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\MiniProgramController@decrypt',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\MiniProgramController@decrypt',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::dcVRH1WVQGs0rKWo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qOKgZvHO57yE2X4V' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/miniprogram.phonenumber',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\MiniProgramController@getPhoneNumber',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\MiniProgramController@getPhoneNumber',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::qOKgZvHO57yE2X4V',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::6yRu8qd28jsGcSv5' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/miniprogram.confirm_login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\MiniProgramController@confirmLogin',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\MiniProgramController@confirmLogin',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::6yRu8qd28jsGcSv5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OOqharu50rwvRTU6' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/officialaccount.login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\OfficialAccountController@login',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\OfficialAccountController@login',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::OOqharu50rwvRTU6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::t4MGLYMghS6TNagS' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user/user.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\UserController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\UserController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::t4MGLYMghS6TNagS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YVz2d0fRhvz2mg5K' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user/info.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\UserInfoController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\UserInfoController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::YVz2d0fRhvz2mg5K',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::knBKWRTngxff2QRr' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/info.updateAvatar',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\UserInfoController@updateAvatar',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\UserInfoController@updateAvatar',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::knBKWRTngxff2QRr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::nYyo6r3QrNpjxat9' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/info.updateName',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\UserInfoController@updateName',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\UserInfoController@updateName',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::nYyo6r3QrNpjxat9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::H9z6gKzgtIbKb7wi' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/password.reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\PasswordController@reset',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\PasswordController@reset',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::H9z6gKzgtIbKb7wi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mZJHJqYRz0TJKQwO' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/phone.bind',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\PhoneController@bind',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\PhoneController@bind',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::mZJHJqYRz0TJKQwO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Cgw9wzMD8qbrqu40' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/email.bind',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\EmailController@bind',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\EmailController@bind',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::Cgw9wzMD8qbrqu40',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Bj27Bv5JEDR9dWSg' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\ProfileController@profile',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\ProfileController@profile',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::Bj27Bv5JEDR9dWSg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZHkKYLGyBheaS3Nn' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/profile.update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\ProfileController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\ProfileController@update',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::ZHkKYLGyBheaS3Nn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::uBChq7GfS3htCuxu' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user/account',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\AccountController@getAccount',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\AccountController@getAccount',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::uBChq7GfS3htCuxu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::42q9OfmXutyhNZi9' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/account.resetpassword',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\AccountController@resetPassword',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\AccountController@resetPassword',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::42q9OfmXutyhNZi9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::oaZnKv5SiedGFQSa' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/account.transfer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\AccountController@transfer',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\AccountController@transfer',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::oaZnKv5SiedGFQSa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sPjieL66MXhoHT3U' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user/bill.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\BillController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\BillController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::sPjieL66MXhoHT3U',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::RsKH0cqfgc5Pg824' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user/bill.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\BillController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\BillController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::RsKH0cqfgc5Pg824',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::o3ge48hL65b5GAo6' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user/address.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\AddressController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\AddressController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::o3ge48hL65b5GAo6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Puom8PGfpkmjdEbU' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user/address.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\AddressController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\AddressController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::Puom8PGfpkmjdEbU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2uwjxcWGmBBOSJN7' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/address.create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\AddressController@create',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\AddressController@create',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::2uwjxcWGmBBOSJN7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::1ZFm25CBh4ixhNxa' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/address.update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\AddressController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\AddressController@update',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::1ZFm25CBh4ixhNxa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::enFSBB2tdR8Pwlvk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/address.delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\AddressController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\AddressController@delete',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::enFSBB2tdR8Pwlvk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0btJH42F0ecbZzH4' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/address.setDefault',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\AddressController@setDefault',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\AddressController@setDefault',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::0btJH42F0ecbZzH4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Xcd5iN08pHl9XqIK' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user/notification',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\NotificationController@notification',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\NotificationController@notification',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::Xcd5iN08pHl9XqIK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PYnOTj1YYjcyLqxk' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user/readnotification',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\NotificationController@readNotifications',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\NotificationController@readNotifications',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::PYnOTj1YYjcyLqxk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::I3oGXwkkp678z8U5' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user/unreadnotification',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\NotificationController@unreadNotification',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\NotificationController@unreadNotification',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::I3oGXwkkp678z8U5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::O2GKl7bcyXsaJ3P2' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user/notification.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\NotificationController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\NotificationController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::O2GKl7bcyXsaJ3P2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::zgbs4yxjJScQlyrP' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/notification.delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\NotificationController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\NotificationController@delete',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::zgbs4yxjJScQlyrP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::DC7EQVtLQjaOhxWx' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user/transfer.commonly',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\TransferController@commonly',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\TransferController@commonly',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::DC7EQVtLQjaOhxWx',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::DPu2Kti1AXf97IUg' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user/transfer.search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\TransferController@search',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\TransferController@search',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::DPu2Kti1AXf97IUg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5fkmii1o8vqR6rtX' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user/transfer.find',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\TransferController@find',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\TransferController@find',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::5fkmii1o8vqR6rtX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jDJNTbv404m3aAxi' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user/position.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\PositionController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\PositionController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::jDJNTbv404m3aAxi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Q2VCGs90LqHdBySM' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user/position.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\PositionController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\PositionController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::Q2VCGs90LqHdBySM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::EXuObl9jYx2EYagD' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/position.create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\PositionController@create',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\PositionController@create',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::EXuObl9jYx2EYagD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::1digCzha12hW7F5E' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/position.update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\PositionController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\PositionController@update',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::1digCzha12hW7F5E',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PP80ndxqSJBHHYXb' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/position.delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\PositionController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\PositionController@delete',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::PP80ndxqSJBHHYXb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2lTCe7d01NtztagM' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user/education.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\EducationController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\EducationController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::2lTCe7d01NtztagM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rN3rSrZGHRqqa5Dp' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user/education.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\EducationController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\EducationController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::rN3rSrZGHRqqa5Dp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::W6cFTiKoKK5ptzLB' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/education.create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\EducationController@create',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\EducationController@create',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::W6cFTiKoKK5ptzLB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mj6plPbvWavHMRor' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/education.update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\EducationController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\EducationController@update',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::mj6plPbvWavHMRor',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kGxCmVLnwrUCVAl0' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/education.delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\EducationController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\EducationController@delete',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::kGxCmVLnwrUCVAl0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OS1fpdt7QM18nZ6j' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user/job.intention.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\JobIntentionController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\JobIntentionController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::OS1fpdt7QM18nZ6j',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GpNxRGPymEUORcWp' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/job.intention.create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\JobIntentionController@create',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\JobIntentionController@create',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::GpNxRGPymEUORcWp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::JoEvIVYyF4ISARUA' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/job.intention.update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\JobIntentionController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\JobIntentionController@update',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::JoEvIVYyF4ISARUA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::B9lb1Jf9KFP6CqUe' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/job.intention.delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\JobIntentionController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\JobIntentionController@delete',
        'namespace' => 'App\\Http\\Controllers\\Api\\User',
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::B9lb1Jf9KFP6CqUe',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CNzy0QRp52v17WJk' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/common/district.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Common\\DistrcitController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Common\\DistrcitController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Common',
        'prefix' => 'api/common',
        'where' => 
        array (
        ),
        'as' => 'generated::CNzy0QRp52v17WJk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tMR5ltwY7kgPTuUv' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/common/district.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Common\\DistrcitController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Common\\DistrcitController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Common',
        'prefix' => 'api/common',
        'where' => 
        array (
        ),
        'as' => 'generated::tMR5ltwY7kgPTuUv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::AmwYiE2wFzgo1zK0' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/common/district.getCityList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Common\\DistrcitController@getCityList',
        'controller' => 'App\\Http\\Controllers\\Api\\Common\\DistrcitController@getCityList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Common',
        'prefix' => 'api/common',
        'where' => 
        array (
        ),
        'as' => 'generated::AmwYiE2wFzgo1zK0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::evDTdS8CIziGSaGk' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/common/block.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Common\\BlockController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Common\\BlockController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Common',
        'prefix' => 'api/common',
        'where' => 
        array (
        ),
        'as' => 'generated::evDTdS8CIziGSaGk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::E3tk9RHb0ajgPJYa' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/common/block.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Common\\BlockController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Common\\BlockController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Common',
        'prefix' => 'api/common',
        'where' => 
        array (
        ),
        'as' => 'generated::E3tk9RHb0ajgPJYa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hHfVUDUcZ3ZeOdvn' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/common/block.item.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Common\\BlockItemController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Common\\BlockItemController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Common',
        'prefix' => 'api/common',
        'where' => 
        array (
        ),
        'as' => 'generated::hHfVUDUcZ3ZeOdvn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IPUcr7Uelq3LBLlI' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/common/material.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Common\\MaterialController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Common\\MaterialController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Common',
        'prefix' => 'api/common',
        'where' => 
        array (
        ),
        'as' => 'generated::IPUcr7Uelq3LBLlI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::m1XDr5gNFfqDCgGs' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/common/material.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Common\\MaterialController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Common\\MaterialController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Common',
        'prefix' => 'api/common',
        'where' => 
        array (
        ),
        'as' => 'generated::m1XDr5gNFfqDCgGs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::DHrQ09kJTVPvpwfs' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/common/material.upload',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Common\\MaterialController@upload',
        'controller' => 'App\\Http\\Controllers\\Api\\Common\\MaterialController@upload',
        'namespace' => 'App\\Http\\Controllers\\Api\\Common',
        'prefix' => 'api/common',
        'where' => 
        array (
        ),
        'as' => 'generated::DHrQ09kJTVPvpwfs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::keQcpghfqUCTe3Kf' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/common/express.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Common\\ExpressController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Common\\ExpressController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Common',
        'prefix' => 'api/common',
        'where' => 
        array (
        ),
        'as' => 'generated::keQcpghfqUCTe3Kf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wtyIs0jqZVJyrNiL' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/common/express.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Common\\ExpressController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Common\\ExpressController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Common',
        'prefix' => 'api/common',
        'where' => 
        array (
        ),
        'as' => 'generated::wtyIs0jqZVJyrNiL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::AZmLCiDDnLGBJg0H' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/common/menu.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Common\\MenuController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Common\\MenuController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Common',
        'prefix' => 'api/common',
        'where' => 
        array (
        ),
        'as' => 'generated::AZmLCiDDnLGBJg0H',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::eJelJzbOUy7YYIAD' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/common/kefu.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Common\\KefuController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Common\\KefuController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Common',
        'prefix' => 'api/common',
        'where' => 
        array (
        ),
        'as' => 'generated::eJelJzbOUy7YYIAD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::exGbpp7WIjixuwNH' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/common/kefu.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Common\\KefuController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Common\\KefuController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Common',
        'prefix' => 'api/common',
        'where' => 
        array (
        ),
        'as' => 'generated::exGbpp7WIjixuwNH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::otaT9I3acyR2ZFyI' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/common/link.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Common\\LinkController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Common\\LinkController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Common',
        'prefix' => 'api/common',
        'where' => 
        array (
        ),
        'as' => 'generated::otaT9I3acyR2ZFyI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7X4p1G034o7udTFl' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/common/link.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Common\\LinkController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Common\\LinkController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Common',
        'prefix' => 'api/common',
        'where' => 
        array (
        ),
        'as' => 'generated::7X4p1G034o7udTFl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::U73BKE9ztaJcC87Q' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/common/ad.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Common\\AdController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Common\\AdController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Common',
        'prefix' => 'api/common',
        'where' => 
        array (
        ),
        'as' => 'generated::U73BKE9ztaJcC87Q',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::zvGG8G5tsEHi4TPE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/common/ad.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Common\\AdController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Common\\AdController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Common',
        'prefix' => 'api/common',
        'where' => 
        array (
        ),
        'as' => 'generated::zvGG8G5tsEHi4TPE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Jn6M9ssIyNEDgnZo' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/common/apns/jpush',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Common\\ApnsController@jpush',
        'controller' => 'App\\Http\\Controllers\\Api\\Common\\ApnsController@jpush',
        'namespace' => 'App\\Http\\Controllers\\Api\\Common',
        'prefix' => 'api/common',
        'where' => 
        array (
        ),
        'as' => 'generated::Jn6M9ssIyNEDgnZo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::xksyxQyAzDv3iwIZ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/common/feedback.create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Common\\FeedbackController@create',
        'controller' => 'App\\Http\\Controllers\\Api\\Common\\FeedbackController@create',
        'namespace' => 'App\\Http\\Controllers\\Api\\Common',
        'prefix' => 'api/common',
        'where' => 
        array (
        ),
        'as' => 'generated::xksyxQyAzDv3iwIZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MUfabSAEC1cgSAdn' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/page/page.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Page\\PageController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Page\\PageController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Page',
        'prefix' => 'api/page',
        'where' => 
        array (
        ),
        'as' => 'generated::MUfabSAEC1cgSAdn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qcwitslMgjs6ov8I' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/page/page.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Page\\PageController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Page\\PageController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Page',
        'prefix' => 'api/page',
        'where' => 
        array (
        ),
        'as' => 'generated::qcwitslMgjs6ov8I',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IVhauZI442D9q2HE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/page/category.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Page\\CategoryController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Page\\CategoryController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Page',
        'prefix' => 'api/page',
        'where' => 
        array (
        ),
        'as' => 'generated::IVhauZI442D9q2HE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Nk6MFuooIZJSlqpL' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/trade/bought.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\BoughtController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\BoughtController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::Nk6MFuooIZJSlqpL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::l5WD6kJdOrWxRoUS' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/trade/bought.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\BoughtController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\BoughtController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::l5WD6kJdOrWxRoUS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5z7No1H68TxNJxUh' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/trade/bought.notice',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\BoughtController@notice',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\BoughtController@notice',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::5z7No1H68TxNJxUh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::HGEXZDYEQhgW3XlK' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/trade/bought.cancel',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\BoughtController@cancel',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\BoughtController@cancel',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::HGEXZDYEQhgW3XlK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZkZ9WSbNAGhjGd1z' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/trade/bought.confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\BoughtController@confirm',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\BoughtController@confirm',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::ZkZ9WSbNAGhjGd1z',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::q1hn7I7bEOhSzPxz' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/trade/bought.delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\BoughtController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\BoughtController@delete',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::q1hn7I7bEOhSzPxz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::11eC9LleCcvVq9s8' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/trade/bought.getTradeList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\BoughtController@getTradeList',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\BoughtController@getTradeList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::11eC9LleCcvVq9s8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KvdqQxtCTxOktODH' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/trade/bought.getTradeDetail',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\BoughtController@getTradeDetail',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\BoughtController@getTradeDetail',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::KvdqQxtCTxOktODH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qknJTBxYsdzXvRyR' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/trade/sold/info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\SoldController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\SoldController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::qknJTBxYsdzXvRyR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::L2fHIaTKEUkAVpro' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/trade/sold/list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\SoldController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\SoldController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::L2fHIaTKEUkAVpro',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::nVwXiTZWKYT442FB' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/trade/sold/adjustprice',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\SoldController@adjustPrice',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\SoldController@adjustPrice',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::nVwXiTZWKYT442FB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kmMYOkFdhBMFevUO' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/trade/sold/send',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\SoldController@send',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\SoldController@send',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::kmMYOkFdhBMFevUO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::no0qBbbi3v61utlK' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/trade/order.pay',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\OrderPayController@pay',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\OrderPayController@pay',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::no0qBbbi3v61utlK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::LewADvV3jQX25NGt' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/trade/refund.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\RefundController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\RefundController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::LewADvV3jQX25NGt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sGyOm68ogdMbi99j' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/trade/refund.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\RefundController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\RefundController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::sGyOm68ogdMbi99j',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::xN9joNlfDSUCymd6' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/trade/refund.apply',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\RefundController@apply',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\RefundController@apply',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::xN9joNlfDSUCymd6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8gaEdqZl8emii8zl' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/trade/refund.create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\RefundController@create',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\RefundController@create',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::8gaEdqZl8emii8zl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sXzlDkxAGSiHcT32' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/trade/refund.update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\RefundController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\RefundController@update',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::sXzlDkxAGSiHcT32',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::1f66LdCbSYelGfDt' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/trade/refund.revoke',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\RefundController@revoke',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\RefundController@revoke',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::1f66LdCbSYelGfDt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9n1DTHtzLWgtOOWt' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/trade/refund.delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\RefundController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\RefundController@delete',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::9n1DTHtzLWgtOOWt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4chKU8FAEpdvRunj' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/trade/refund.send',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\RefundController@send',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\RefundController@send',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::4chKU8FAEpdvRunj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MBiK45R26Vkz3GaL' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/trade/refund.getReasonList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\RefundController@getReasonList',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\RefundController@getReasonList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::MBiK45R26Vkz3GaL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::dIIkvpsbITdJyoXl' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/trade/refund.getTradeDetail',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\RefundController@getTradeDetail',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\RefundController@getTradeDetail',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::dIIkvpsbITdJyoXl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::B5QrQFBWpImguxeR' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/trade/refund.getAddress',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Trade\\RefundController@getAddress',
        'controller' => 'App\\Http\\Controllers\\Api\\Trade\\RefundController@getAddress',
        'namespace' => 'App\\Http\\Controllers\\Api\\Trade',
        'prefix' => 'api/trade',
        'where' => 
        array (
        ),
        'as' => 'generated::B5QrQFBWpImguxeR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IIYJ6CFw2pJEvAR0' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/ecom/product.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\ProductItemController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\ProductItemController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::IIYJ6CFw2pJEvAR0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YoYZQAFRonyYcZly' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/ecom/product.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\ProductItemController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\ProductItemController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::YoYZQAFRonyYcZly',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KBd00uY6RqU9kk2f' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/ecom/product.content.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\ProductContentController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\ProductContentController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::KBd00uY6RqU9kk2f',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MHiKJIDZHD8ChNOI' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/ecom/product.subscribe.create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\ProductSubscribeController@create',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\ProductSubscribeController@create',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::MHiKJIDZHD8ChNOI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qpbohF3aO95aEtCB' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/ecom/product.subscribe.delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\ProductSubscribeController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\ProductSubscribeController@delete',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::qpbohF3aO95aEtCB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::y1GXT7ovzvZ41177' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/ecom/product.subscribe.toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\ProductSubscribeController@toggle',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\ProductSubscribeController@toggle',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::y1GXT7ovzvZ41177',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jJZHyU6DACWelXQ4' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/ecom/product.subscribe.query',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\ProductSubscribeController@query',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\ProductSubscribeController@query',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::jJZHyU6DACWelXQ4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bKkCVqH6S8Gm2QT5' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/ecom/product.subscribe.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\ProductSubscribeController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\ProductSubscribeController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::bKkCVqH6S8Gm2QT5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::80HluYD8hFRohGSs' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/ecom/product.category.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\ProductCategoryController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\ProductCategoryController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::80HluYD8hFRohGSs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::03wImTxTIL5CHT8k' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/ecom/product.category.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\ProductCategoryController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\ProductCategoryController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::03wImTxTIL5CHT8k',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cgns6Jabt0V2nJnZ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/ecom/shop.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\ShopController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\ShopController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::cgns6Jabt0V2nJnZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::67Ow9kfBbhUZNhHp' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/ecom/shop.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\ShopController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\ShopController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::67Ow9kfBbhUZNhHp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Nc9IraFW0hTzDbo8' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/ecom/shop.getShopItemCount',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\ShopController@getShopItemCount',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\ShopController@getShopItemCount',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::Nc9IraFW0hTzDbo8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bFTqt0S3P5Et8cHM' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/ecom/shop.subscribe.create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\ShopSubscribeController@create',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\ShopSubscribeController@create',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::bFTqt0S3P5Et8cHM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cNu42D8F8IZt7B8G' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/ecom/shop.subscribe.delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\ShopSubscribeController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\ShopSubscribeController@delete',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::cNu42D8F8IZt7B8G',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::d576UDgWBgILsoNX' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/ecom/shop.subscribe.toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\ShopSubscribeController@toggle',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\ShopSubscribeController@toggle',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::d576UDgWBgILsoNX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::AF5f7i2663gYckIj' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/ecom/shop.subscribe.query',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\ShopSubscribeController@query',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\ShopSubscribeController@query',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::AF5f7i2663gYckIj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PwgUghGHSsOgHDOS' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/ecom/shop.subscribe.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\ShopSubscribeController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\ShopSubscribeController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::PwgUghGHSsOgHDOS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tqMQUTOHkQBhoJjM' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/ecom/cart.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\CartController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\CartController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::tqMQUTOHkQBhoJjM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Q4ZwOxASGdHpCKQZ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/ecom/cart.create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\CartController@create',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\CartController@create',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::Q4ZwOxASGdHpCKQZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fEoO4wfkbAt4BT94' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/ecom/cart.delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\CartController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\CartController@delete',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::fEoO4wfkbAt4BT94',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fP0fnrInv6rYRyzl' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/ecom/cart.updateQuantity',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\CartController@updateQuantity',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\CartController@updateQuantity',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::fP0fnrInv6rYRyzl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9cFwf1DQS1I8BPhW' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/ecom/cart.confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\CartController@confirm',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\CartController@confirm',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::9cFwf1DQS1I8BPhW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::U0kS6ahqgrt3WDNC' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/ecom/cart.settlement',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\CartController@settlement',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\CartController@settlement',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::U0kS6ahqgrt3WDNC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vdhyu1jDyRCf5nSc' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/ecom/order.calculate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\OrderController@calculate',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\OrderController@calculate',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::vdhyu1jDyRCf5nSc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VYDGyPuZ5QSegbo7' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/ecom/order.create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ecom\\OrderController@create',
        'controller' => 'App\\Http\\Controllers\\Api\\Ecom\\OrderController@create',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::VYDGyPuZ5QSegbo7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ofDgdH2gbYXn768M' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/ecom/order.close.reasons',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:317:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:99:"function () {            return jsonSuccess([\'items\' => \\trans(\'trade.close_reasons\')]);        }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000001abf7a5a000000000c996eec";}";s:4:"hash";s:44:"ho3hcxWNxOXzzmOCIZm+xqsb0hz8UvzHvntPsgj95rg=";}}',
        'namespace' => 'App\\Http\\Controllers\\Api\\Ecom',
        'prefix' => 'api/ecom',
        'where' => 
        array (
        ),
        'as' => 'generated::ofDgdH2gbYXn768M',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MWXxDtDpLCOrHZTa' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/post/item.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Post\\ItemController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Post\\ItemController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Post',
        'prefix' => 'api/post',
        'where' => 
        array (
        ),
        'as' => 'generated::MWXxDtDpLCOrHZTa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::o3MLWQdCfY9Ni3oX' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/post/item.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Post\\ItemController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Post\\ItemController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Post',
        'prefix' => 'api/post',
        'where' => 
        array (
        ),
        'as' => 'generated::o3MLWQdCfY9Ni3oX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jcc0ZEr7TGwk31Sn' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/post/content.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Post\\ContentController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Post\\ContentController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Post',
        'prefix' => 'api/post',
        'where' => 
        array (
        ),
        'as' => 'generated::jcc0ZEr7TGwk31Sn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::HilTukRxo2afdUye' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/post/category.getInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Post\\CategoryController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Post\\CategoryController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Post',
        'prefix' => 'api/post',
        'where' => 
        array (
        ),
        'as' => 'generated::HilTukRxo2afdUye',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7GhfhIooVLysHTor' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/post/category.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Post\\CategoryController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Post\\CategoryController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Post',
        'prefix' => 'api/post',
        'where' => 
        array (
        ),
        'as' => 'generated::7GhfhIooVLysHTor',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2KenIgo9sh8SfCzI' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/post/subscribe.getList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Post\\SubscribeController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Post\\SubscribeController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Post',
        'prefix' => 'api/post',
        'where' => 
        array (
        ),
        'as' => 'generated::2KenIgo9sh8SfCzI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3oaw3lMbXNJz03lA' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/post/subscribe.toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Post\\SubscribeController@toggle',
        'controller' => 'App\\Http\\Controllers\\Api\\Post\\SubscribeController@toggle',
        'namespace' => 'App\\Http\\Controllers\\Api\\Post',
        'prefix' => 'api/post',
        'where' => 
        array (
        ),
        'as' => 'generated::3oaw3lMbXNJz03lA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ww5VkM7fnorInNNA' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/post/subscribe.delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Post\\SubscribeController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\Post\\SubscribeController@delete',
        'namespace' => 'App\\Http\\Controllers\\Api\\Post',
        'prefix' => 'api/post',
        'where' => 
        array (
        ),
        'as' => 'generated::ww5VkM7fnorInNNA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZrlJLBsvKgM3pIbP' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/post/subscribe.query',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Post\\SubscribeController@query',
        'controller' => 'App\\Http\\Controllers\\Api\\Post\\SubscribeController@query',
        'namespace' => 'App\\Http\\Controllers\\Api\\Post',
        'prefix' => 'api/post',
        'where' => 
        array (
        ),
        'as' => 'generated::ZrlJLBsvKgM3pIbP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vSR6DCNuZGjmjXUv' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/live/info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Live\\LiveController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Live\\LiveController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Live',
        'prefix' => 'api/live',
        'where' => 
        array (
        ),
        'as' => 'generated::vSR6DCNuZGjmjXUv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::xN3WXfIZVPh3JuwM' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/live/list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Live\\LiveController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Live\\LiveController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Live',
        'prefix' => 'api/live',
        'where' => 
        array (
        ),
        'as' => 'generated::xN3WXfIZVPh3JuwM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GISBUSL6DgUUQsQO' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/live/channel/info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Live\\ChannelController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Live\\ChannelController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Live',
        'prefix' => 'api/live',
        'where' => 
        array (
        ),
        'as' => 'generated::GISBUSL6DgUUQsQO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GXb9Zz4cNJXjXaFy' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/live/channel/list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Live\\ChannelController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Live\\ChannelController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Live',
        'prefix' => 'api/live',
        'where' => 
        array (
        ),
        'as' => 'generated::GXb9Zz4cNJXjXaFy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::k5PCEOnrtJDardzQ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/live/ticket',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Live\\LiveController@getTicket',
        'controller' => 'App\\Http\\Controllers\\Api\\Live\\LiveController@getTicket',
        'namespace' => 'App\\Http\\Controllers\\Api\\Live',
        'prefix' => 'api/live',
        'where' => 
        array (
        ),
        'as' => 'generated::k5PCEOnrtJDardzQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YoLy9lwGbXogVaVw' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/live/ticket/buy',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Live\\LiveController@buyTicket',
        'controller' => 'App\\Http\\Controllers\\Api\\Live\\LiveController@buyTicket',
        'namespace' => 'App\\Http\\Controllers\\Api\\Live',
        'prefix' => 'api/live',
        'where' => 
        array (
        ),
        'as' => 'generated::YoLy9lwGbXogVaVw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::UWBs1KyHT3tJiNDz' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/video/info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Video\\VideoController@getInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Video\\VideoController@getInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Video',
        'prefix' => 'api/video',
        'where' => 
        array (
        ),
        'as' => 'generated::UWBs1KyHT3tJiNDz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::w05V7o3cQD3ufbEj' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/video/list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Video\\VideoController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Video\\VideoController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Video',
        'prefix' => 'api/video',
        'where' => 
        array (
        ),
        'as' => 'generated::w05V7o3cQD3ufbEj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qWig9lv74IiUXT5c' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/video/save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Video\\VideoController@save',
        'controller' => 'App\\Http\\Controllers\\Api\\Video\\VideoController@save',
        'namespace' => 'App\\Http\\Controllers\\Api\\Video',
        'prefix' => 'api/video',
        'where' => 
        array (
        ),
        'as' => 'generated::qWig9lv74IiUXT5c',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Z8OhKdvHWDgz7wa9' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/video/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Video\\VideoController@create',
        'controller' => 'App\\Http\\Controllers\\Api\\Video\\VideoController@create',
        'namespace' => 'App\\Http\\Controllers\\Api\\Video',
        'prefix' => 'api/video',
        'where' => 
        array (
        ),
        'as' => 'generated::Z8OhKdvHWDgz7wa9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OUaDA10YWptvrlUs' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/video/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Video\\VideoController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\Video\\VideoController@delete',
        'namespace' => 'App\\Http\\Controllers\\Api\\Video',
        'prefix' => 'api/video',
        'where' => 
        array (
        ),
        'as' => 'generated::OUaDA10YWptvrlUs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QQgWDlg6c43sonhZ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/video/upload',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Video\\VideoController@upload',
        'controller' => 'App\\Http\\Controllers\\Api\\Video\\VideoController@upload',
        'namespace' => 'App\\Http\\Controllers\\Api\\Video',
        'prefix' => 'api/video',
        'where' => 
        array (
        ),
        'as' => 'generated::QQgWDlg6c43sonhZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CrwXeTBOuWXX05z6' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/video/watch',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Video\\VideoController@watch',
        'controller' => 'App\\Http\\Controllers\\Api\\Video\\VideoController@watch',
        'namespace' => 'App\\Http\\Controllers\\Api\\Video',
        'prefix' => 'api/video',
        'where' => 
        array (
        ),
        'as' => 'generated::CrwXeTBOuWXX05z6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::lNrbvhNq2dKScbOm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/video/like/check',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Video\\LikeController@check',
        'controller' => 'App\\Http\\Controllers\\Api\\Video\\LikeController@check',
        'namespace' => 'App\\Http\\Controllers\\Api\\Video',
        'prefix' => 'api/video',
        'where' => 
        array (
        ),
        'as' => 'generated::lNrbvhNq2dKScbOm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ABT2sM5D5fv5np4d' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/video/like/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Video\\LikeController@toggle',
        'controller' => 'App\\Http\\Controllers\\Api\\Video\\LikeController@toggle',
        'namespace' => 'App\\Http\\Controllers\\Api\\Video',
        'prefix' => 'api/video',
        'where' => 
        array (
        ),
        'as' => 'generated::ABT2sM5D5fv5np4d',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Y1N2zJuLKN3JzHBA' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/video/like/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Video\\LikeController@create',
        'controller' => 'App\\Http\\Controllers\\Api\\Video\\LikeController@create',
        'namespace' => 'App\\Http\\Controllers\\Api\\Video',
        'prefix' => 'api/video',
        'where' => 
        array (
        ),
        'as' => 'generated::Y1N2zJuLKN3JzHBA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::LkssdqMcx12ddqfH' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/video/like/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Video\\LikeController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\Video\\LikeController@delete',
        'namespace' => 'App\\Http\\Controllers\\Api\\Video',
        'prefix' => 'api/video',
        'where' => 
        array (
        ),
        'as' => 'generated::LkssdqMcx12ddqfH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Ymev34sfBhsOKd5c' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/video/comment/list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Video\\CommentController@getList',
        'controller' => 'App\\Http\\Controllers\\Api\\Video\\CommentController@getList',
        'namespace' => 'App\\Http\\Controllers\\Api\\Video',
        'prefix' => 'api/video',
        'where' => 
        array (
        ),
        'as' => 'generated::Ymev34sfBhsOKd5c',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::oLbSUhlJZnBrrjgP' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/video/comment/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Video\\CommentController@create',
        'controller' => 'App\\Http\\Controllers\\Api\\Video\\CommentController@create',
        'namespace' => 'App\\Http\\Controllers\\Api\\Video',
        'prefix' => 'api/video',
        'where' => 
        array (
        ),
        'as' => 'generated::oLbSUhlJZnBrrjgP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3cvxigpchOmN1H8Q' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/lbs/geocode.geo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Lbs\\GeoCodeController@geo',
        'controller' => 'App\\Http\\Controllers\\Api\\Lbs\\GeoCodeController@geo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Lbs',
        'prefix' => 'api/lbs',
        'where' => 
        array (
        ),
        'as' => 'generated::3cvxigpchOmN1H8Q',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BDEslp1gLxXZVhFY' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/lbs/geocode.regeo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Lbs\\GeoCodeController@regeo',
        'controller' => 'App\\Http\\Controllers\\Api\\Lbs\\GeoCodeController@regeo',
        'namespace' => 'App\\Http\\Controllers\\Api\\Lbs',
        'prefix' => 'api/lbs',
        'where' => 
        array (
        ),
        'as' => 'generated::BDEslp1gLxXZVhFY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KBMmtopdXaEZ0Q1k' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/app/getversion',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:550:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:331:"function () {    $userAgent = \'time:\' . \\time() . \',\' . $_SERVER[\'HTTP_USER_AGENT\'];    if (\\strpos($userAgent, \'Android\') || \\strpos($userAgent, \'okhttp\')) {        return jsonSuccess([\'version\' => 1.0, \'userAgent\' => $userAgent]);    } else {        return jsonSuccess([\'version\' => 1.0, \'userAgent\' => $userAgent]);    }}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000001abf75dc000000000c996eec";}";s:4:"hash";s:44:"qrkIumvPfNuDwnZ7MpDyg3iUYgi4zANaNmzajtFaQoQ=";}}',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::KBMmtopdXaEZ0Q1k',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::50B1KCUOKta70jF9' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => 'api/reachable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:259:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:41:"function () {    return jsonSuccess();}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000001abf7a7a000000000c996eec";}";s:4:"hash";s:44:"v5aJsbDIlE4x7/yrvvUP1p+rxF2QF3LySQI2mmsef28=";}}',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::50B1KCUOKta70jF9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7RdijqdX6F02b5RW' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => 'notify/wechat/officalaccount/server',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Notify\\Wechat\\OfficialAccountController@server',
        'controller' => 'App\\Http\\Controllers\\Notify\\Wechat\\OfficialAccountController@server',
        'namespace' => 'App\\Http\\Controllers\\Notify\\Wechat',
        'prefix' => 'notify/wechat',
        'where' => 
        array (
        ),
        'as' => 'generated::7RdijqdX6F02b5RW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::I8upfPelJKXKqrSU' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => 'notify/wechat/miniprogram/server',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Notify\\Wechat\\MiniProgramController@server',
        'controller' => 'App\\Http\\Controllers\\Notify\\Wechat\\MiniProgramController@server',
        'namespace' => 'App\\Http\\Controllers\\Notify\\Wechat',
        'prefix' => 'notify/wechat',
        'where' => 
        array (
        ),
        'as' => 'generated::I8upfPelJKXKqrSU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::isCdPzWf7TaxyPRf' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => 'notify/wechat/recharge',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Notify\\Wechat\\RechargeController@paid',
        'controller' => 'App\\Http\\Controllers\\Notify\\Wechat\\RechargeController@paid',
        'namespace' => 'App\\Http\\Controllers\\Notify\\Wechat',
        'prefix' => 'notify/wechat',
        'where' => 
        array (
        ),
        'as' => 'generated::isCdPzWf7TaxyPRf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qcqpXagnjqfPvNrP' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => 'notify/wechat/order/paid/{app}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Notify\\Wechat\\OrderController@paid',
        'controller' => 'App\\Http\\Controllers\\Notify\\Wechat\\OrderController@paid',
        'namespace' => 'App\\Http\\Controllers\\Notify\\Wechat',
        'prefix' => 'notify/wechat',
        'where' => 
        array (
        ),
        'as' => 'generated::qcqpXagnjqfPvNrP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::weIocIqbLAE30sHv' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => 'notify/wechat/order/refund/{app}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Notify\\Wechat\\OrderController@refund',
        'controller' => 'App\\Http\\Controllers\\Notify\\Wechat\\OrderController@refund',
        'namespace' => 'App\\Http\\Controllers\\Notify\\Wechat',
        'prefix' => 'notify/wechat',
        'where' => 
        array (
        ),
        'as' => 'generated::weIocIqbLAE30sHv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9GqqyicPNyCMZ5wi' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => 'notify/wechat/peisong/paid',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Notify\\Wechat\\PeiSongController@paid',
        'controller' => 'App\\Http\\Controllers\\Notify\\Wechat\\PeiSongController@paid',
        'namespace' => 'App\\Http\\Controllers\\Notify\\Wechat',
        'prefix' => 'notify/wechat',
        'where' => 
        array (
        ),
        'as' => 'generated::9GqqyicPNyCMZ5wi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::suPwueuTmHftHgl5' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => 'notify/wechat/dache/paid',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Notify\\Wechat\\DacheController@paid',
        'controller' => 'App\\Http\\Controllers\\Notify\\Wechat\\DacheController@paid',
        'namespace' => 'App\\Http\\Controllers\\Notify\\Wechat',
        'prefix' => 'notify/wechat',
        'where' => 
        array (
        ),
        'as' => 'generated::suPwueuTmHftHgl5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CiHNEgIDGHTuqBRC' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => 'notify/wechat/vip/paid',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Notify\\Wechat\\VipController@paid',
        'controller' => 'App\\Http\\Controllers\\Notify\\Wechat\\VipController@paid',
        'namespace' => 'App\\Http\\Controllers\\Notify\\Wechat',
        'prefix' => 'notify/wechat',
        'where' => 
        array (
        ),
        'as' => 'generated::CiHNEgIDGHTuqBRC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2gARGh0Jy2vzzI2e' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => 'notify/alipay/order.paid',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Notify\\Alipay\\OrderController@paid',
        'controller' => 'App\\Http\\Controllers\\Notify\\Alipay\\OrderController@paid',
        'namespace' => 'App\\Http\\Controllers\\Notify\\Alipay',
        'prefix' => 'notify/alipay',
        'where' => 
        array (
        ),
        'as' => 'generated::2gARGh0Jy2vzzI2e',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::W0VoF2jJGRB7qzjz' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => 'notify/live/on_publish',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Notify\\Live\\LiveController@onPublish',
        'controller' => 'App\\Http\\Controllers\\Notify\\Live\\LiveController@onPublish',
        'namespace' => 'App\\Http\\Controllers\\Notify\\Live',
        'prefix' => 'notify/live',
        'where' => 
        array (
        ),
        'as' => 'generated::W0VoF2jJGRB7qzjz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rwaHwR53fZ7eeh4k' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => 'notify/live/on_publish_done',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Notify\\Live\\LiveController@onPublishDone',
        'controller' => 'App\\Http\\Controllers\\Notify\\Live\\LiveController@onPublishDone',
        'namespace' => 'App\\Http\\Controllers\\Notify\\Live',
        'prefix' => 'notify/live',
        'where' => 
        array (
        ),
        'as' => 'generated::rwaHwR53fZ7eeh4k',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cCVg4GFDEtxq1tFB' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => 'notify/live/live/paid/{appid}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Notify\\Live\\LiveController@paid',
        'controller' => 'App\\Http\\Controllers\\Notify\\Live\\LiveController@paid',
        'namespace' => 'App\\Http\\Controllers\\Notify\\Live',
        'prefix' => 'notify/live',
        'where' => 
        array (
        ),
        'as' => 'generated::cCVg4GFDEtxq1tFB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::M4kEYQyyfTU5gETH' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'h5/page/{id}.html',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\H5\\PageController@detail',
        'controller' => 'App\\Http\\Controllers\\H5\\PageController@detail',
        'namespace' => 'App\\Http\\Controllers\\H5',
        'prefix' => 'h5',
        'where' => 
        array (
        ),
        'as' => 'generated::M4kEYQyyfTU5gETH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vVxZJuscD7XtGq5v' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'h5/post/{aid}.html',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\H5\\PostController@detail',
        'controller' => 'App\\Http\\Controllers\\H5\\PostController@detail',
        'namespace' => 'App\\Http\\Controllers\\H5',
        'prefix' => 'h5',
        'where' => 
        array (
        ),
        'as' => 'generated::vVxZJuscD7XtGq5v',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
