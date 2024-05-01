import { Controller } from '@hotwired/stimulus';

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
  initialize() {
    this._onPreConnect = this._onPreConnect.bind(this);
    this._onConnect = this._onConnect.bind(this);
  }

  connect() {
    this.element.addEventListener('autocomplete:pre-connect', this._onPreConnect);
    this.element.addEventListener('autocomplete:connect', this._onConnect);

  }

  disconnect() {
    // You should always remove listeners when the controller is disconnected to avoid side-effects
    this.element.removeEventListener('autocomplete:connect', this._onConnect);
    this.element.removeEventListener('autocomplete:pre-connect', this._onPreConnect);
  }

  _onPreConnect(event) {
    // TomSelect has not been initialized - options can be changed
    //console.log(event.detail.options.render.option); // Options that will be used to initialize TomSelect
    event.detail.options.create= true;
    event.detail.options.render.option_create = function( data, escape ){
      return '<div class="create">Ajouter <strong>' + escape(data.input) + '</strong>&hellip;</div>';
    }
    event.detail.options.shouldLoad= function (query, callback) {
      if (query.length > 3) {//if search has at least 4 chars
        return true;
      }
    },
    event.detail.sortField = [{
      'field' : 'text',
      'direction' : 'asc',
    }]
    //console.log(event);
    event.detail.sort = [{'text': 'asc'}]
    event.detail.options.min_characters = 3;
    event.detail.options.maxOptions = 100;
    event.detail.options.max_options = 100;
    event.detail.options.maxItems = 1;
    //event.detail.tomSelect.openOnFocus = false;
   /* event.detail.options.onChange = (value) => {
      console.log(value);
    };*/
  }

  _onConnect(event) {


    // TomSelect has just been intialized and you can access details from the event
     /*console.log(event.detail.tomSelect); // TomSelect instance
     console.log(event.detail.options); // Options used to initialize TomSelect*/
  }

}
