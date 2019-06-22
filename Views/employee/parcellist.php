<h1>Lista przesyłek</h1>
<table class="users-list" border="1">
    <tr>
        <th>ID</th>
        <th>Status</th>
        <th>Kraj</th>
        <th>Kod pocztowy</th>
        <th>Miasto</th>
        <th>Ulica</th>
        <th>Number domu / mieszkania</th>
        <th>Akcje</th>
    </tr>
    <?php foreach ($parcels as $parcel): ?>
        <tr>
            <td><?= $parcel->getId(); ?></td>
            <td>
                <?php if ($parcel->getStatus() === "inprogress"): ?>
                    <i class="fas fa-hourglass-half"></i>
                <?php elseif ($parcel->getStatus() === "pending"): ?>
                    <i class="fas fa-user-slash"></i>
                <?php elseif ($parcel->getStatus() === "finished"): ?>
                    <i class="fas fa-check-circle"></i>
                <?php endif; ?>
            </td>
            <td><?= $parcel->getCountry(); ?></td>
            <td><?= $parcel->getPostalCode(); ?></td>
            <td><?= $parcel->getCity(); ?></td>
            <td><?= $parcel->getStreet(); ?></td>
            <td><?= $parcel->getHouseNumber() . (!empty($parcel->getApartmentNumber()) ? " / {$parcel->getApartmentNumber()}" : ""); ?></td>
            <td>
                <?php if ($parcel->getStatus() === "finished"): ?>

                    Zlecenie ukończone

                <?php else: ?>

                    <?php if (in_array($parcel->getId(), $usersAssignedParcels)): ?>
                        <stron>Moje zlecenie</stron>
                        <button class="button-assign" onclick="unassign(event)"
                                data-parcel-id="<?= $parcel->getId(); ?>">
                            Rezygnuj
                        </button>
                        <button class="button-assign" onclick="finish(event)" data-parcel-id="<?= $parcel->getId(); ?>">
                            Zrealizowano
                        </button>
                    <?php elseif ($parcel->getStatus() !== "inprogress"): ?>
                        <button class="button-assign" onclick="assign(event)" data-parcel-id="<?= $parcel->getId(); ?>">
                            Przypisz do siebie
                        </button>
                    <?php endif; ?>

                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<script type="text/javascript">
  function assign(event) {
    var button = event.target;
    var parcelId = button.getAttribute("data-parcel-id");

    var req = new XMLHttpRequest();
    req.open('POST', '/pcichon/employee/assignparcel?parcelId=' + parcelId + "&userId=<?= $_SESSION["userId"] ?>", true);
    req.onreadystatechange = function (aEvt) {
      if (req.readyState == 4) {
        if (req.status == 200) {
          if (JSON.parse(req.responseText).success) {
            button.parentNode.innerHTML = `
                  <stron>Moje zlecenie</stron>
                        <button class="button-assign" onclick="unassign(event)" data-parcel-id="${parcelId}">
                            Rezygnuj
                        </button>
                        <button class="button-assign" onclick="finish(event)" data-parcel-id="${parcelId}">
                            Zrealizowano
                        </button>
            `;
          } else {
            alert("Błąd");
          }
        } else {
          alert("Błąd");
        }
      }
    };
    req.send(null);
  }

  function unassign(event) {
    var button = event.target;
    var parcelId = button.getAttribute("data-parcel-id");
    console.log(parcelId);

    var req = new XMLHttpRequest();
    req.open('POST', '/pcichon/employee/unassignparcel?parcelId=' + parcelId + "&userId=<?= $_SESSION["userId"] ?>", true);
    req.onreadystatechange = function (aEvt) {
      req.onreadystatechange = function (aEvt) {
        if (req.readyState == 4) {
          if (req.status == 200) {
            if (JSON.parse(req.responseText).success) {
              button.parentNode.innerHTML = `<button class="button-assign" onclick="assign(event)" data-parcel-id="${parcelId}">
                    Przypisz do siebie
                </button>`;
            } else {
              alert("Błąd");
            }
          } else {
            alert("Błąd");
          }
        }
      }
      };
      req.send(null);
    }

    function finish(event) {
      var button = event.target;
      var parcelId = button.getAttribute("data-parcel-id");
      console.log(parcelId);

      var req = new XMLHttpRequest();
      req.open('POST', '/pcichon/employee/finishparcel?parcelId=' + parcelId + "&userId=<?= $_SESSION["userId"] ?>", true);
      req.onreadystatechange = function (aEvt) {
        if (req.readyState == 4) {
          if (req.status == 200) {
            if (JSON.parse(req.responseText).success) {
              button.parentNode.innerHTML = ` Zlecenie ukończone`;
            } else {
              alert("Błąd");
            }
          } else {
            alert("Błąd");
          }
        }
      };
      req.send(null);
    }
</script>