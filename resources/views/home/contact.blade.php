@extends("layouts.front.app")

@section('title', 'Contact')

@section('banner')

<div class="about-contents">
    <h1 class="mb-2">CONTACT</h1>
    <p style="text-align: center;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem temporibus error ullam fuga qui voluptatibus repellat earum dolore, illo doloribus neque fugit eos eligendi, a nihil quae. Quia, obcaecati nesciunt?</p>
    <a href="#">Contactez-nous</a>
</div>

@endsection

@section("content")
    <main>
        <section class="mb-2 py-2">
            <div class="wrap">
                <div class="devis-info-contact">
                    <div class="contacts-info mt-5">
                        <div class="fid-number">
                            <i  class="fas fa-phone" style="color: #083EA9; background-color: white; border-radius: 50%; padding: 5%;"></i>
                            <p>(+225) 27 24 36 11 97  <br>(+225) 01 01 73 50 02</p>
                        </div>
                        <div class="fid-number">
                            <i  class="fas fa-envelope" style="color: #083EA9; background-color: white; border-radius: 50%; padding: 5%;"></i>
                            <p>contact@firme-informatique.com</p>
                        </div>
                        <div class="fid-number">
                            <i  class="fas fa-map-marker-alt" style="color: #083EA9; background-color: white; border-radius: 50%; padding: 5%;"></i>
                            <p>Angré Nouveau CHU</p>
                        </div>
                    </div>
                    <div class="devis" id="devis">
                        <div class="formulaire" data-aos="fade-left" data-aos-duration="1000" data-aos-once="true">
                            <form action="{{ route('contact.store') }}" method="POST">
                                @csrf

                                <div class="present">
                                    <div class="div">
                                        <input type="text" name="nom" placeholder="Entrez votre nom">
                                    </div>
                                    <div class="div">
                                        <input type="text" name="prenom" placeholder="Entrez votre prenom">
                                    </div>
                                </div>
                                <div class="present">
                                    <div class="div">
                                        <input type="email" name="email" placeholder="Entrez votre email">
                                    </div>
                                    <div class="div">
                                        <input type="text" name="telephone" placeholder="Entrez votre numero">
                                    </div>
                                </div>
                                <select name="digit" id="digital">
                                    <option disabled selected class="default">Selectionner le service qui vous intéresse</option>
                                    <option value="Fourniture de consommables et accessoires informatique">Fourniture de consommables et accessoires informatique</option>
                                    <option value="Founiture de materiels informatiques">Founiture de matériels informatiques</option>
                                    <option value="Founiture de solutions informatiques">Founiture de solutions informatiques</option>
                                    <option value="Entretien et maintenance de materiels informatique">Entretien et maintenance de matériels informatique</option>
                                    <option value="Travaux de câblages réseaux informatiques et informatiques">Travaux de câblages réseaux informatiques et informatiques</option>
                                </select>
                                <textarea name="besoin" id="besoin" placeholder="Décrivez votre besoin"></textarea>
                                <button type="submit">Envoyer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mb-2 py-5">
            <div class="wrap">
                <div class="title">
                    <h1>Retrouvez nous sur google map</h1>
                </div>
            </div>
        </section>

        <section class="py-3 mb-5">
            <div class="wrap">
                <div class="frame">
                    {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.120959420287!2d-3.960804799999999!3d5.398535799999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1ed21e0ebdea3%3A0x1a25ff6b2ba8f672!2sFirme%20Attou%20%26%20Co!5e0!3m2!1sen!2sci!4v1734608376817!5m2!1sen!2sci"  height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.120810470106!2d-3.9633708255247484!3d5.398558535213888!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc193f9dd7a3203%3A0xcc1099b92711588!2sFirme%20de%20l&#39;informatique!5e0!3m2!1sfr!2sci!4v1747662695194!5m2!1sfr!2sci" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>


    </main>
@endsection