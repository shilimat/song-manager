# SongPlayer 🎵  
**SongPlayer** is a song management and playback application that allows users to explore songs, albums, genres, and artists. Admins can perform full CRUD operations to manage song-related data. The latest version introduces exciting sharing capabilities and enhanced navigation features.

---

## Features  
### General Features  
- **Browse & Play:** Explore songs by artists, albums, and genres.  
- **Artist Profiles:** View artist biographies and their popular songs.  

### Admin Features  
- **CRUD Operations:** Manage songs, albums, genres, and artists.  

### New Features  
#### Sharing Functionality  
- **Shareable Links:** Songs now have shareable links.  
- **"Share" Button:** Quickly copy or share links for popular songs.  

#### Enhanced Navigation  
- **Clickable Links:** Popular songs in artist profiles link directly to detailed song pages.  
- **Seamless Experience:** Navigate effortlessly through artist profiles and song details.  

---

## Installation  

### Prerequisites  
Ensure the following tools are installed:  
- **PHP** >= 8.0  
- **Composer**  
- **MySQL** or a compatible database  

### Steps  

1. **Clone the Repository**  
   ```bash  
   git clone https://github.com/shilimat/song-manager.git  
   cd song-manager  
   ```  

2. **Install Dependencies**  
   ```bash  
   composer install  
   ```  

3. **Set Up Environment File**  
   - Duplicate `.env.example` as `.env`:  
     ```bash  
     cp .env.example .env  
     ```  
   - Update database credentials and configurations in `.env`.  

4. **Run Migrations & Seed Data**  
   ```bash  
   php artisan migrate --seed  
   ```  

5. **Start the Development Server**  
   ```bash  
   php artisan serve  
   ```  

6. **Access the Application**  
   Open your browser and visit: [http://localhost:8000](http://localhost:8000).  

---

## Usage  

### Admin Features  
- Manage songs, artists, albums, and genres through an intuitive admin panel.  
- Edit or delete existing entries as needed.  

### User Features  
- Browse artists, albums, genres, and songs.  
- Discover and share popular songs using unique URLs.  

---

## File Structure  

### Backend  
- **Controllers:** Handle requests and route logic.  
- **Models:** Represent database entities.  
- **Routes:** Configure web and API routes.  

### Frontend  
- **Blade Templates:** Define HTML structure with dynamic data rendering.  
- **CSS/JS:** Handle styling and interactivity.  

---

## Testing  

### Unit Tests  
Run tests to validate application logic:  
```bash  
php artisan test  
```  

### Manual Testing  
- Verify CRUD operations for all entities.  
- Test sharing links and navigation for popular songs.  

---

## Contributing  

1. **Fork the Repository**.  
2. **Create a Feature Branch**:  
   ```bash  
   git checkout -b feature-name  
   ```  
3. **Commit Changes**:  
   ```bash  
   git commit -m "Add feature-name"  
   ```  
4. **Push Changes**:  
   ```bash  
   git push origin feature-name  
   ```  
5. **Create a Pull Request**.  

---

## License  
This project is licensed under the **MIT License**.  

---

## Authors  
- Shilimat Tadele
- Samiya Mohammedawol
- Solome Getachew
- Sumaya Omer
- Timar Tizazu  
