'use strict';

module.exports = {
  runMultiTask: function (init_params) {

    var reestr = (init_params !== undefined) ? init_params : [];

    return function (dto) {

      var closure = dto.fn;
      var projects = dto.projects;
      var cb = dto.cb;

      if (projects === undefined || projects === null)
        projects = reestr['projects'];

      if (reestr['projects'] === undefined)
        reestr['projects'] = projects;



      // projects.forEach(function (item, i) {
      var sync = true;
      var counter = 0;
      for (var i in projects) {

        var item = projects[i];

        console.log(item);

        new Promise(function(resolve, reject) {
        closure(item, counter, reestr, resolve, reject);
        }).then(function () {
          sync = false;
        }).catch(e => console.log(e));

        if( dto.toSync === true )
          while(sync) {require('deasync').sleep(100); }

        counter++;
      }
      // });

      return ( cb !== undefined ) ? cb() : null;

    }


  }
};