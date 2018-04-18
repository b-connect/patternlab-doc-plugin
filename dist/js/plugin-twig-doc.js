
var TwigDocPlugin = {

	insert: function(panels, patternData, iframePassback, switchText) {
    // console.log(panels);
    var id = '#sg-' + patternData + '-pl-panel-variables-panel'
    $(panels).find(id).html('<pre class="language-markup"></pre>');
    var table = $(panels).find('table.variables').remove();
    $(panels).find(id).find('pre').append(table);

    var id = '#sg-' + patternData + '-pl-panel-variables-links'
    $(panels).find(id).html('<pre class="language-markup"></pre>');
    var table = $(panels).find('ul.links').remove();
    $(panels).find(id).find('pre').append(table);
    if (table.length === 0) {
      $(panels).find(id).find('pre').html('');
    }
  },

}
Panels.add({
	'id': 'pl-panel-variables',
	'name': 'Variables',
	'default': false,
	'templateID': 'pl-panel-template-code',
	'httpRequest': true,
	'httpRequestReplace': fileSuffixMarkup + '.html',
	'httpRequestCompleted': false,
	'prismHighlight': true,
	'language': 'markup',
  'keyCombo': 'ctrl+shift+y'
})

Panels.add({
	'id': 'pl-panel-links',
	'name': 'Links',
	'default': false,
	'templateID': 'pl-panel-template-code',
	'httpRequest': true,
	'httpRequestReplace': fileSuffixMarkup + '.html',
	'httpRequestCompleted': false,
	'prismHighlight': true,
	'language': 'markup',
  'keyCombo': 'ctrl+shift+y'
})