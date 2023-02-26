<div class="modal fade" id="editinfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content h-25">
        <div class="modal-body container p-5">
          <form action="editinfo.php" method="POST" enctype="multipart/form-data">
            <h2 class="text-center">Modifier le profil</h2>
            <div class=" d-flex flex-column gap-3">
              <div>
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" id="nom" placeholder="Nom"/>
              </div>
              <div>
                <label for="prenom" class="form-label">Prenom</label>
                <input type="text" min="0" name="prenom" class="form-control" id="prenom" placeholder="Prenom"/>

              </div>
              <div>
                <label for="telephon" class="form-label">Telephone</label>
                <input type="number" name="telephon" class="form-control" id="telephon" minlenght="10" maxlength="10" placeholder="Telephone"  />

              </div>
              <div>
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email"  />
              </div>
              <div>
                <label for="mot_passe" class="form-label">Mot de passe</label>
                <div class="input-group">
                <input type="password" name="mot_passe" class="form-control" id="mot_passe" placeholder="mot de passe"  />
                <span class="input-group-text"  id="togglePassword"><i class="fa fa-eye-slash"></i></span>
                </div>
              </div>
              <div>
                <label for="mot_passe_confirm" class="form-label">Confirmation de mot de passe</label>
                <div class="input-group">
                   <input type="password" name="mot_passe_confirm" class="form-control" id="mot_passe_confirm" placeholder="mot de passe"  />
                   <span class="input-group-text" ><i class="fa fa-eye-slash" id="togglePasswordconfirm"></i></span>
                </div>
              </div>
              <div class="justify-content-end d-flex">
                <button name="updatprofil" value="updatprofil" type="submit" class="btn bg-dark text-white" id="updatprofil">Modifier</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>