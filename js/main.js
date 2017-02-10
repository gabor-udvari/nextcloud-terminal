document.addEventListener('DOMContentLoaded', function() {
// if ( false ) {

var terminalContainer = document.getElementById('terminal-container'),
  term = new Terminal(),
  socket,
  termid;

term.open(terminalContainer);

// get size from term.fit or a default if not exist
if (typeof term.fit == "function") {
  term.fit();
} else {
  var cols=60,
      rows=20;
}

if (document.location.pathname) {
  var parts = document.location.pathname.split('/'),
    base = parts.slice(0, parts.length - 1).join('/') + '/',
    resource = base.substring(1) + 'socket.io';

  /*
  console.log(resource);
  resource = 'socket.io';
  socket = io.connect(null, { resource: resource });
  // */

  // override
  // /*
  resource = 'https://felho.sfv.udvari.org/socket.io';
  socket = io.connect(null, {resource: 'socket.io'});
  // */
} else {
  socket = io.connect();
}

term.debug = true;

// send create to server
socket.emit('create', term.cols, term.rows, function(err, data) {
  if (err) return self._destroy();
  self.pty = data.pty;
  self.id = data.id;
  termid = self.id;
  // self.setProcessName(data.process);
  term.emit('open tab', self);
  // self.emit('open');
});

term.writeln('Welcome to xterm.js');
term.writeln('Connecting to websocket...');

term.on('data', function(data) {
  socket.emit('data', termid, data);
});

term.on('resize', function(c, r) {
  socket.emit('resize', termid, c, r);
});

socket.on('connect', function() {
  // term.reset();
  term.writeln('Connected.');
  term.writeln('');
});

socket.on('data', function(id, data) {
  term.write(data);
});

}, false); // end of onLoad
