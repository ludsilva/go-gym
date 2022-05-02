function convert() {
  let doc = new jsPDF(
    {
      orientation: 'landscape'
    }
  );
  let elementHTML = $('#content').html();
  let specialElementHandlers = {
      '#elementH': function (element, renderer) {
          return true;
      }
  };
  doc.fromHTML(elementHTML, 15, 15, {
    'width': 170,
    'elementHandlers': specialElementHandlers
  }, function cb() {} );

  // Save the PDF
  doc.save('relatorio.pdf');
}