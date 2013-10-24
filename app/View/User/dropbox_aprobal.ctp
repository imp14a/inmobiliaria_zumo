<script src="https://www.dropbox.com/static/api/1/dropbox-datastores-0.1.0-b5.js" type="text/javascript"></script>





<body>
</body>




<script>
var client = new Dropbox.Client({key: "9k02w2941zhrgps"});

// Try to finish OAuth authorization.
client.authenticate({interactive: false}, function (error) {
    if (error) {
        alert('Authentication error: ' + error);
    }
});

if (client.isAuthenticated()) {
    console.log("se autentifico");
}

client.authenticate();
</script>