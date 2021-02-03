$(document).ready(function() {
			function loadData(page) {
				$.ajax({
					url: "research_pagination.php",
					type: "POST",
					cache: false,
					data: {
						page_no: page
					},
					success: function(response) {
						$("#research-content").html(response);
					}
				});
			}
			loadData();

			// Pagination code
			$(document).on("click", ".pagination li a", function(e) {
				e.preventDefault();
				var pageId = $(this).attr("id");
				loadData(pageId);
			});
		});