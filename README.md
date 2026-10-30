<p align="center">
  <img src=".github/banner.svg" alt="Cloud Storage – bestanden uploaden en delen" width="100%">
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Tailwind%20CSS-06B6D4?logo=tailwindcss&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Chart.js-FF6384?logo=chartdotjs&logoColor=white" alt="Chart.js">
</p>

# Cloud Storage

Een soort mini Google Drive. Je logt in, uploadt je bestanden, bekijkt en verwijdert ze, en deelt ze met andere gebruikers via hun e-mailadres. Hier leerde ik hoe je uploads veilig afhandelt en hoe je regelt wie welk bestand mag zien.

## Functies

- **Account aanmaken en inloggen**. Wachtwoorden worden versleuteld opgeslagen met `password_hash`.
- **Uploaden**: JPG, PNG, GIF, PDF en DOCX. Andere bestandstypes worden geweigerd.
- **Je eigen bestanden** bekijken en verwijderen (`home.php`).
- **Delen** met een andere gebruiker op e-mailadres, en zien wat er met jou gedeeld is (`share.php`).
- **Admin-pagina** met het aantal gebruikers in een grafiek (Chart.js). Alleen gebruikers met de rol `admin` komen erin.
- Alle databasequery's gebruiken **prepared statements** (PDO).

## Zelf draaien

Je hebt een lokale webserver met PHP en MySQL nodig, bijvoorbeeld XAMPP.

1. Clone het project in de map van je webserver:
   ```bash
   git clone https://github.com/ParisAngelopoulos/cloud-storage2.git
   ```
2. Maak in phpMyAdmin een database aan met de naam `file_sharing`.
3. Importeer daarin het bestand `file_sharing (4).sql`.
4. Ga naar http://localhost/cloud-storage2/files en maak een account aan.

De verbinding met de database staat in `files/db.php`. Geüploade bestanden komen in `files/uploads/`; die map wordt vanzelf aangemaakt.

Wil je de admin-pagina zien? Zet dan in de tabel `users` bij je eigen account de kolom `role` op `admin`.

## Mappen

| Bestand | Wat het doet |
| --- | --- |
| `files/index.php` | Inloggen |
| `files/register.php` | Account aanmaken |
| `files/home.php` | Je bestanden en het uploadformulier |
| `files/upload.php` | Controleert en bewaart een upload |
| `files/share.php` | Bestanden delen en gedeelde bestanden bekijken |
| `files/admin_page.php` | Overzicht voor de admin |

---

Gemaakt door **Paris Angelopoulos**, web developer in opleiding · [GitHub](https://github.com/ParisAngelopoulos) · [parisangelopoulos@gmail.com](mailto:parisangelopoulos@gmail.com)
