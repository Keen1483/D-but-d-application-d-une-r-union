<div id="dailyActivity">
  <h2>Entrées du jour</h2>
  <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
      Entrées du jour
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item dt" href="#">Divers tontines</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item sct" href="#">Sanctions</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item fs" href="#">Fonds secours</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item fnf" href="#">Fanfare</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item int" href="#">Intérêts</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item dv" href="#">Divers</a>
    </div>
  </div>

  <div id="dt" class="entrjr">
      <fieldset>
        <legend>
          Entrées divers tontines
        </legend>
          <form action="" method="post">
            <p>
              <?= $formsDiversTontines ?>
          
              <input type="hidden" name="table" value="caisse_divers_tontines">
              <input type="submit" value="Ajouter" />
            </p>
          </form>
      </fieldset>
      <i class="material-icons">remove_circle_outline</i>
  </div>


  <div id="sct" class="entrjr">
      <fieldset>
        <legend>
        Entrées sanctions
        </legend>
          <form action="" method="post">
            <p>
              <?= $formsSanctions ?>
          
              <input type="hidden" name="table" value="caisse_sanctions">
              <input type="submit" value="Ajouter" />
            </p>
          </form>
      </fieldset>
      <i class="material-icons">remove_circle_outline</i>
  </div>


  <div id="fs" class="entrjr">
      <fieldset>
        <legend>
        Entrées fonds secours
        </legend>
          <form action="" method="post">
            <p>
              <?= $formsFondsSecours ?>
          
              <input type="hidden" name="table" value="caisse_fonds_secours">
              <input type="submit" value="Ajouter" />
            </p>
          </form>
      </fieldset>
      <i class="material-icons">remove_circle_outline</i>
  </div>


  <div id="fnf" class="entrjr">
      <fieldset>
        <legend>
        Entrées fanfare
        </legend>
          <form action="" method="post">
            <p>
              <?= $formsFanfare ?>
          
              <input type="hidden" name="table" value="caisse_fanfare">
              <input type="submit" value="Ajouter" />
            </p>
          </form>
      </fieldset>
      <i class="material-icons">remove_circle_outline</i>
  </div>


  <div id="int" class="entrjr">
      <fieldset>
        <legend>
        Entrées intérêts
        </legend>
          <form action="" method="post">
            <p>
              <?= $formsInterets ?>
          
              <input type="hidden" name="table" value="caisse_interets">
              <input type="submit" value="Ajouter" />
            </p>
          </form>
      </fieldset>
      <i class="material-icons">remove_circle_outline</i>
  </div>


  <div id="dv" class="entrjr">
      <fieldset>
        <legend>
        Entrées divers
        </legend>
          <form action="" method="post">
            <p>
              <?= $formsDivers ?>
          
              <input type="hidden" name="table" value="caisse_divers">
              <input type="submit" value="Ajouter" />
            </p>
          </form>
      </fieldset>
      <i class="material-icons">remove_circle_outline</i>
  </div>
</div>