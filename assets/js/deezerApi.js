var userToken;

function login() {
    DZ.login(function (response) {
        if (response.authResponse) {
            console.log('Welcome!  Fetching your information.... ');
            DZ.api('/user/me', function (response) {
                console.log('Good to see you, ' + response.name + '.');
            });
            userToken = response.authResponse.accessToken;
        } else {
            console.log('User cancelled login or did not fully authorize.');
        }
    }, { perms: 'email, manage_library' });
};

