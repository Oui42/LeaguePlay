			</div>
		</div>
		<div id="footer">
			LeaguePlay.net &copy; 2017.<br>
			<a href="">Terms of service</a> |
			<a href="index.php?app=main&module=main&section=rules">Rules</a> |
			<a href="index.php?app=user&module=tickets&section=new&type=<?php echo $__ticketType['support']; ?>">Support ticket</a>
		</div>
		<script>
			ClassicEditor
			.create (document.querySelector('#editor'), {
				toolbar: ['headings', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo'],
				heading: {
					options: [
						{ modelElement: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
						{ modelElement: 'heading1', viewElement: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
						{ modelElement: 'heading2', viewElement: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
						{ modelElement: 'heading3', viewElement: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
					]
				}
			})
			.catch (error => {
				console.error(error);
			});

			$(document).ready(function(){
				$('ul.tabs li').click(function(){
					var tab_id = $(this).attr('data-tab');

					$('ul.tabs li').removeClass('current');
					$('.tab-content').removeClass('current');

					$(this).addClass('current');
					$("#"+tab_id).addClass('current');
				})
			})
		</script>
	</body>
</html>