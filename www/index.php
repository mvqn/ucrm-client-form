<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UCRM Client Form</title>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
        integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz"
        crossorigin="anonymous">
    <!-- Bootstrap (CSS) CDN -->
    <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">

    <!-- Our own CSS files -->
    <link rel="stylesheet" href="css/form.css">

</head>
<body>
    <div class="container">
        <h2>Customer Request Form</h2>

        <form id="signUpForm" action="submit.php" method="post">
            <!-- Include PHP Config and initialize a javascript object for it as well! -->
            <?php $config = include("config.php"); ?>
            <script>let config = <?php echo json_encode($config); ?>;</script>

            <h4>Service Type</h4>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <input id="clientTypeResidential" class="form-check-input"
                        type="radio"
                        name="clientType"
                        value="1"
                        checked
                        onclick="typeChanged(this)" />
                    <label class="form-check-label" for="clientTypeResidential">Residential</label>
                </div>
                <div class="form-check form-check-inline">
                    <input id="clientTypeCommercial" class="form-check-input"
                        type="radio"
                        name="clientType"
                        value="2"
                        onclick="typeChanged(this)" />
                    <label class="form-check-label" for="clientTypeCommercial">Commercial</label>
                </div>
            </div>

            <h4>Contact</h4>
            <div id="companyNameGroup" class="form-group" style="display:none">
                <input id="companyName" class="form-control"
                    type="text"
                    name="companyName"
                    placeholder="Company Name" />
                <label for="companyName" class="sr-only">Company Name</label>
            </div>
            <div class="form-group">
                <input id="firstName" class="form-control"
                    type="text"
                    name="firstName"
                    placeholder="First Name" />
                <label for="firstName" class="sr-only">First Name</label>
            </div>
            <div class="form-group">
                <input id="lastName" class="form-control"
                    type="text"
                    name="lastName"
                    placeholder="Last Name" />
                <label for="lastName" class="sr-only">Last Name</label>
            </div>
            <div class="form-group">
                <input id="email" class="form-control"
                    type="email"
                    name="email"
                    aria-describedby="emailHelp"
                    placeholder="Email" />
                <label for="email" class="sr-only">Email</label>
                <small id="emailHelp" class="form-text text-muted">Your email will never be shared with anyone.</small>
            </div>
            <div class="form-group">
                <input id="phone" class="form-control"
                       type="text"
                       name="phone"
                       placeholder="Phone" />
                <label for="phone" class="sr-only">Phone</label>
            </div>

            <h4>Address</h4>

            <div class="form-group">
                <input id="street1" class="form-control"
                    type="text"
                    name="street1"
                    aria-describedby="street1Help"
                    placeholder="Address Line 1"
                    onkeyup="updateAddress()" />
                <label for="street1" class="sr-only">Address Line 1</label>
                <small id="street1Help" class="form-text text-muted">Street address, P.O. Box, company name, c/o, etc.</small>
            </div>

            <div class="form-group">
                <input id="street2" class="form-control"
                    type="text"
                    name="street2"
                    aria-describedby="street2Help"
                    placeholder="Address Line 2"
                    onkeyup="updateAddress()" />
                <label for="street2" class="sr-only">Address Line 2</label>
                <small id="street2Help" class="form-text text-muted">Apartment, suite, unit, floor, etc.</small>
            </div>

            <div class="form-group">
                <input id="city" class="form-control"
                    type="text"
                    name="city"
                    placeholder="City / Town"
                    onkeyup="updateAddress()" />
                <label for="city" class="sr-only">City / Town</label>
            </div>

            <div class="form-group">
                <input id="state" class="form-control"
                    type="text"
                    name="state"
                    placeholder="State / Province / Region"
                    onkeyup="updateAddress()" />
                <label for="state" class="sr-only">State / Province / Region</label>
            </div>

            <div class="form-group">
                <input id="zip" class="form-control"
                    type="text"
                    name="zipCode"
                    placeholder="Zip / Postal Code"
                    onkeyup="updateAddress()" />
                <label for="zip" class="sr-only">Zip / Postal Code</label>
            </div>

            <div class="form-group">
                <input id="country" class="form-control"
                    type="text"
                    name="country"
                    placeholder="Country"
                    onkeyup="updateAddress()" />
                <label for="city" class="sr-only">Country</label>
            </div>

            <h4>Location</h4>
            <div class="form-group">
                <div class="input-group">
                    <input id="geocode" class="form-control"
                        type="text"
                        name="geocode"
                        aria-describedby="geocodeHelp"
                        readonly
                         />
                    <div class="input-group-append">
                        <div id="geocodeButton" class="btn btn-secondary rounded-right disabled"
                            onclick="geocodeAddress(this)">
                            Geocode
                        </div>
                    </div>
                    <label for="geocode" class="sr-only">Geocode</label>
                </div>
                <small id="geocodeHelp" class="form-text text-muted">
                    After entering your address above and then clicking the "geocode" button, please be sure to position
                    the marker as close as possible to your desired service location.
                </small>
            </div>
            <div class="form-group">
                <div id="map"></div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col">
                        <label for="latitude">Latitude</label>
                        <input id="latitude" class="form-control"
                               type="text"
                               name="latitude"
                               readonly />
                    </div>
                    <div class="col">
                        <label for="longitude">Longitude</label>
                        <input id="longitude" class="form-control"
                               type="text"
                               name="longitude"
                               readonly />
                    </div>
                </div>
            </div>

            <h4>Terms of Service</h4>
            <div class="form-group">
                <!-- TODO: Change your terms of service as desired! -->
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet asperiores aut autem commodi culpa
                    cumque eligendi ex exercitationem fuga maiores, modi, porro quidem sapiente sequi totam vero vitae,
                    voluptas voluptatum?
                </p>
                <p>
                    Culpa cupiditate deserunt dolores et, ipsam laboriosam non, sunt, tempora ut vero vitae voluptas
                    voluptatem voluptatum? Adipisci blanditiis consequatur dignissimos earum, eius et exercitationem
                    impedit itaque officiis quis sint ut!
                </p>
                <p>
                    Nobis non, perspiciatis? Atque consectetur culpa, cupiditate dignissimos ducimus, eius eligendi
                    eveniet incidunt itaque laboriosam maxime, minus modi necessitatibus nisi obcaecati perferendis quia
                    quibusdam quo repudiandae sed sunt ullam voluptate.
                </p>
                <div class="form-check">
                    <label class="form-check-label">
                <input id="agreement" class="form-check-input"
                       type="checkbox"
                       name="agreement"
                       aria-describedby="agreementHelp"
                       value="yes"
                       onchange="updateAgreement(this)" />
                        <strong>Check here to indicate that you have read and agree to the "Terms of Service".</strong>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <div id="signUpButton" class="btn btn-primary btn-block disabled" onclick="submit(this)">Sign-Up</div>
            </div>

        </form>
    </div>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>

    <!-- Bootstrap (JS) CDN -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

    <!-- jQuery Validation CDN -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>

    <!-- Our own JS files -->
    <script src="js/validation.js"></script>
    <script src="js/form.js"></script>

    <!-- Google Maps API (Must be loaded after our custom JS files) -->
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $config["mapsApiKey"]; ?>&callback=refreshMap">
    </script>

</body>
</html>