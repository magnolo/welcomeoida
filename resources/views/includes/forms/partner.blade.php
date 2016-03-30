<div class="row form">
  <div class="row">
  <h3 class="col s12 center-align">Partner*in werden!</h3>
  </div>
  <form id="partner">

    <div class="row">
      <div class="input-field  col s12">
        <input type="text" minlength="3" required name="partner_name" id="partner_name" />
        <label for="event_title">Name</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field  col s12">
        <input type="email" minlength="3" required name="partner_email" id="partner_email" />
        <label for="partner_email">Email</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field  col s12">
          <input type="text" minlength="3"  required name="partner_phone" id="partner_phone" />
        <label for="partner_phone">Telefon</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input type="text" minlength="3" required name="partner_location" id="partner_location" />
        <label for="partner_location">Adresse</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field  col s12">
          <input type="text" minlength="3"  required name="partner_url" id="partner_url" />
        <label for="partner_url">Website</label>
      </div>
    </div>
    <div class="row">
      <div class="col s12">
        <div class="dropzone needsclick dz-clickable" id="logo-uploader">
          <div class="dz-message needsclick">
          <i class="fa fa-picture-o"></i><br />
          Logo hochladen
          </div>
        </div>

      </div>
    </div>
    <div class="row">
      <div class="input-field  col s12">
          <input type="text" minlength="3"  required name="partner_organisation" id="partner_organisation" />
        <label for="partner_organisation">Unternehmen/Organisation</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field  col s12">
        <textarea minlength="3" class="materialize-textarea" name="partner_message" id="partner_message"></textarea>
        <label for="partner_message">Deine Nachricht</label>
      </div>
    </div>
  <div class="row">
  <div class="col s12">
     {!! app('captcha')->display(); !!}
   </div>
  </div>
  <button class="waves-effect waves-light btn full" type="submit" >Absenden</button>
  </form>
</div>
