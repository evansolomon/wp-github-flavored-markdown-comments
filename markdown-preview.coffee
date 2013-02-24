jQuery ( $ )->
	# Cache the comment form and textbox
	commentForm = $ '#commentform'
	textBox     = commentForm.find 'textarea'

	# Get the current text of the user's comment
	getCommentText = ->
		for input in commentForm.serializeArray()
			return input.value if input.name is 'comment'

	# Show the HTML comment as a preview
	render = ( htmlToPreview ) =>
		unless @template?
			comments = $( 'article.comment' )
			@template = comments.first().clone()
			@template.find( '.reply, #respond' ).remove()

			parent = textBox.parents( '#respond' ).prev( '.comment' )
			parent = comments.last() unless parent.is ':visible'
			parent.after @template

		return @template.remove() and delete @template unless htmlToPreview.trim()
		text = @template.find '.comment-content'
		text.html htmlToPreview

	# Refresh the template position if a reply is cancelled or started
	$( '.comment-reply-link, .cancel-comment-reply-link' ).on 'click', =>
		delete @template


	# Callback for keystrokes in the comment form
	textBox.on 'keyup', _.throttle =>
		$.post window.gfm_preview.ajaxurl,
			action: 'gfm_preview'
			gfm_text: getCommentText()
		, ( response ) ->
			render response
	, 200
