<div class="row form z-depth-1 hidden" id="eventForm">
    <div class="row">
    <p class="col s12 center-align">Was planst du!</p>
  </div>
    <form id="event">
        <div class="col s12">
          <div class="dropzone needsclick dz-clickable" id="image-upload">

<div class="dz-message needsclick">
  <i class="fa fa-picture-o"></i><br />
Eventfoto hochladen
</div>

</div>


    <div class="row">

        <div class="input-field  col s12">
          <input type="text" minlength="3" required name="event_title" id="event_title" />
          <label for="event_name">Name des Events</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
          <input type="text" minlength="3" required class="location" name="event_location" id="event_location" />
          <label for="event_location">Adresse</label>
        </div>
      </div>
      <div class="row">

      <div class="input-field  col s12">
        <input type="text" minlength="3" required  name="event_from" id="event_from" />
        <label for="event_from">Uhrzeit</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field  col s12">
        <textarea minlength="3" class="materialize-textarea" required name="event_description" id="event_description"></textarea>
        <label for="event_description">Beschreibung</label>
      </div>
    </div>
    <div class="row">
        <p class="col s12">Kontaktangaben</p>
    </div>
    <div class="row">
      <div class="input-field  col s12">
          <input type="text" minlength="3" required  name="event_phone" id="event_phone" />
        <label>Telefon</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field  col s12">
          <input type="text" minlength="3" required  name="event_url" id="event_url" />
        <label>Website</label>
      </div>
    </div>
    <div class="row">
    <div class="col s12">
       {!! app('captcha')->display(); !!}
     </div>
   </div>
 </div>
   <button class="waves-effect waves-light btn full" type="submit" >Absenden</button>
    </form>
  </div>
