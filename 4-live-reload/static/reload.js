
var currentBuild = null
var liveReload = function () {
    fetch('live-reload.php?' + new URLSearchParams({currentBuild: currentBuild}))
    .then((response) => response.json())
    .then((response) => {
        if (response.disabled) {
            return;
        }
        if (response.reload) {
            window.location.reload();
        }
        if (currentBuild != null && currentBuild != response.build) {
            window.location.reload();
        }
        currentBuild = response.build;
        window.setTimeout(liveReload, 1000);
    })
    .catch((error) => {
      console.error('Error:', error);
      window.setTimeout(liveReload, 1000);
    });
}
window.setTimeout(liveReload, 1);
