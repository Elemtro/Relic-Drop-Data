<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Explore Warframe relic drop chances with Relic DropData. Stay updated with the latest information and visit us on GitHub!" />
    <title>Relics DropData</title>

    <meta name="google-site-verification" content="FvQbD9vCNYBvGKGPwYFxYEPogb9klhNOE2WIMQiOyyk">
    <meta name="keywords" content="Warframe, Relics, Relic Farming, Prime Parts, Void Relics, Lith Relics, Meso Relics, Neo Relics, Axi Relics, Relic Refinement, Relic Rarity, Prime Warframes, Prime Weapons, Ducats Farming, Void Fissures, Relic Rotation, Relic Rewards, Relic Vaulted Items, Relic Trading">
    <meta name="author" content="Andrii">
    <meta name="robots" content="index, follow">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/containers.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap">
</head>

<body>
    <div class="beginning">
        <div class="header">
            <img src="images/AxiRelicIntact.webp" alt="Axi relic logo" class="relic-logo">
            <p class="text">Relic Drop Data</p>
        </div>
        <a href="https://stupodovo.com">
            <img src="images\github-mark-white.png" alt="GitHub logo" class="git-logo">
        </a>
    </div>

    <div class="middle-section">
        <div class="text-container">
            <p class="welcome-txt">
                Welcome to Relic Drop Data!
            </p>
            <p class="text2">
                Here you can search for relic drop chances and drop sources. <span class="break-point">Type at least 2 symbols.</span></p>
            </p>
        </div>

        <form id="myForm" onsubmit="return formSubmit()" action="#" method="get">
            <div class="container">
                <input type="text" class="search-bar" placeholder="Search..." name="query">
                <button type="submit" class="search-button" name="input">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </form>
    </div>
    <div class="result" style="display:none">
        Success
    </div>

    <div class="error" style="display:none">
        <p class="empty-field">
            Our first and only ajax request failed. We are sorry ;-;
        </p>";
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        function formSubmit() {
            var str = $("#myForm").serialize();
            console.log(str); //we can check our string in console

            $.ajax({
                type: 'get',
                url: 'includes/formhandler.inc.php',
                data: str,
                success: function(results) {
                    if (results == 'error!') { //if UNsuccesfull
                        console.log(results);
                        $('#myForm').css('display', 'none');
                        $('.error').css('display', 'flex');
                    } else { //if succesfull
                        $('.result').css('display', 'flex');
                        $('.result').html(results);
                    }
                }
            });
            return false;
        }
    </script>
</body>

</html>