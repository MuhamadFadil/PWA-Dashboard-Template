<?php if (session_status() == PHP_SESSION_NONE) {session_start();} ?>
<!DOCTYPE html><html lang="en">
<head>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- loads Material Icons Outlined font -->
	<link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">

	<!-- loads Material Icons Round font -->
	<link href="https://fonts.googleapis.com/css2?family=Material+Icons+Round" rel="stylesheet">

	<!-- loads Material Icons Sharp font -->
	<link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet">

	<!-- loads Material Icons Two Tone font -->
	<link href="https://fonts.googleapis.com/css2?family=Material+Icons+Two+Tone" rel="stylesheet">
	
	<style>
		.material-icons {
			font-family: 'Material Icons';
			font-weight: normal;
			font-style: normal;
			font-size: 24px;
			/* Preferred icon size */
			display: inline-block;
			line-height: 1;
			text-transform: none;
			letter-spacing: normal;
			word-wrap: normal;
			white-space: nowrap;
			direction: ltr;
			/* Support for all WebKit browsers. */
			-webkit-font-smoothing: antialiased;
			/* Support for Safari and Chrome. */
			text-rendering: optimizeLegibility;
			/* Support for Firefox. */
			-moz-osx-font-smoothing: grayscale;
			/* Support for IE. */
			font-feature-settings: 'liga';
		}

		/* material coloring */
		.material-icons.md-dark {
			color: rgba(0, 0, 0, 0.54);
		}

		.material-icons.md-dark.md-inactive {
			color: rgba(0, 0, 0, 0.26);
		}

		.material-icons.md-light {
			color: rgba(255, 255, 255, 1);
		}

		.material-icons.md-light.md-inactive {
			color: rgba(255, 255, 255, 0.3);
		}

		.material-icons.orange {
			color: #FB8C00;
		}
	</style>
    </head>