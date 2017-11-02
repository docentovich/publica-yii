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

      projects.forEach(function (item, i) {

        // var promise = new Promise(function (resolve, reject) {
         return closure(item, i, reestr);

          // resolve();
        // });

        // promise
        //     .then(
        //         function () {
        //           return;
        //         },
        //         function (error) {
        //           new Error(error);
        //         }
        //     );

      });

      return ( cb !== undefined ) ? cb() : null;

    }


  }
};