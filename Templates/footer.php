
	<footer id="footer">
		<div class="footer">
		<div class="contact">
			<form action="../php/contactus.php" method="POST">
				<?php if ($_SESSION == null): ?>
				<label for="nom">Nom</label>
				<input type="text" id="nom" name="nom" placeholder="Votre nom (optional)">

				<label for="prenom">Prenom</label>
				<input type="text" id="prenom" name="prenom" placeholder="Votre prenom (optional)">

				<label for="mail">E-mail<font color="red">*</font></label>
				<input type="text" id="mail" name="mail" placeholder="Votre E-mail">
				<?php endif; ?>
				<label for="subject">Sujet</label>
				<input type="text" id="subject" name="subject" placeholder="Sujet (optional)">

				<label for="message">Message<font color="red">*</font></label>
				<textarea id="message" name="message" placeholder="Ecrit quelque chose.." style="height:200px"></textarea>

				<input type="submit" name="submail" value="Envoyer">
			</form>
		</div>
		<div class="map">
			<iframe class="map" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13225.626811157183!2d-4.9768663!3d34.0334371!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x64ed183ba63abde7!2sFacult%C3%A9%20des%20Sciences%20Dhar%20El%20Mehraz!5e0!3m2!1sen!2sma!4v1614467280707!5m2!1sen!2sma" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
		</div>
		</div>
		
	</footer>
