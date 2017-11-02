  "use strict";
  $(function(){
  // If absolute URL from the remote server is provided, configure the CORS
  // header on that server.
 // var url = 'pdfs/original/test-mult.pdf';
  var url = 'pdfs/original/test-single.pdf';

  // The workerSrc property shall be specified.
  PDFJS.workerSrc = 'js/pdf.worker.js';

  var pdfDoc = null,
      pageNum = 1,
      pageRendering = false,
      pageNumPending = null,
      scale = 1.0,
      canvas = $('#draw')[0],
      grid_canvas = $('#theGrid'),
      ctx = canvas.getContext('2d');

  /**
   * Get page info from document, resize canvas accordingly, and render page.
   * @param num Page number.
   */
  function renderPage(num) {
    var el = $(".page-active");
    el.removeClass("page-active");
    var target = $('[page="'+num+'"]');
    target.addClass("page-active");
      pageRendering = true;
      // Using promise to fetch the page
      pdfDoc.getPage(num).then(function (page) {
          canvas.width = 800;
          var correctScale=canvas.width / page.getViewport(scale).width;
          var viewport = page.getViewport(correctScale);
          canvas.height = viewport.height;
        
          // Render PDF page into canvas context
          var renderContext = {
              canvasContext: ctx,
              viewport: viewport
          };
          var renderTask = page.render(renderContext);

          // Wait for rendering to finish
          renderTask.promise.then(function () {
              pageRendering = false;
              if (pageNumPending !== null) {
                  // New page rendering is pending
                  renderPage(pageNumPending);
                  pageNumPending = null;
              }
          });
      });

      // Update page counters
      pageNum = num;
      document.getElementById('page_num').textContent = pageNum;
  }

  /**
   * If another page rendering in progress, waits until the rendering is
   * finised. Otherwise, executes rendering immediately.
   */
  function queueRenderPage(num) {
      if (pageRendering) {
          pageNumPending = num;
      } else {
          renderPage(num);
      }
  }

  /**
   * Displays previous page.
   */
  function onPrevPage() {
      if (pageNum <= 1) {
          return;
      }
      pageNum--;
      queueRenderPage(pageNum);
  }

  document.getElementById('prev').addEventListener('click', onPrevPage);

  /**
   * Displays next page.
   */
  function onNextPage() {
      if (pageNum >= pdfDoc.numPages) {
          return;
      }
      pageNum++;
      queueRenderPage(pageNum);
  }

  document.getElementById('next').addEventListener('click', onNextPage);

  /**
   * Asynchronously downloads PDF.
   */
  PDFJS.getDocument(url).then(function (pdfDoc_) {
      pdfDoc = pdfDoc_;
      var pages = [];
      while (pages.length < pdfDoc_.numPages) pages.push(pages.length + 1);
      document.getElementById('page_count').textContent = pdfDoc.numPages;


      return Promise.all(pages.map(function (num) {
          // create a div for each page and build a small canvas for it
          var div = document.createElement("div");
          div.setAttribute("page",num);
          div.addEventListener("click",onThumbClick);
         if (num === 1) {
           div.classList.add("page-active");
         }
          document.getElementById("thumbnail-pdf").appendChild(div);
          return pdfDoc_.getPage(num).then(makeThumb)
              .then(function (canvas) {
                  div.appendChild(canvas);
              });
      })).then(function(){
                // Initial/first page rendering
                renderPage(pageNum);
               });
  }).catch(console.error);

  function onThumbClick(event) {
    var page = parseInt(event.currentTarget.getAttribute("page"),10);

    renderPage(page);
  }

  function makeThumb(page) {
      // draw page to fit into 96x96 canvas
      var vp = page.getViewport(1);
      var canvas = document.createElement("canvas");
      canvas.width = canvas.height = 96;
      var scale = Math.min(canvas.width / vp.width, canvas.height / vp.height);
      return page.render({
        canvasContext: canvas.getContext("2d"),
        viewport: page.getViewport(scale)
    }).promise.then(function () {
        return canvas;
    });
}



$('#gridOn').on('click', function(e) {
    if ($(this).prop('checked')) {
      grid_canvas.addClass('grid');
    }
    else {
      grid_canvas.removeClass('grid');
    }
  });

});
  