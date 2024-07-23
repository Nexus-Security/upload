
# File Upload Dashboard

This project sets up a PHP-based file upload dashboard using Docker. The dashboard allows you to upload files, view them, and manage them through a web interface.

## Setup Instructions

1. **Clone the Repository**

   Clone the repository to your local machine:

   ```sh
   git clone https://github.com/Nexus-Security/upload.git
   ```

2. **Navigate to the Project Directory**

   Change to the project directory:

   ```sh
   cd upload
   ```

3. **Start the Docker Container**

   Use Docker Compose to build and start the services:

   ```sh
   docker-compose up -d
   ```

4. **Access the Dashboard**

   Open your web browser and navigate to `http://localhost:8888` to access the file upload dashboard.

## PHP Upload Limits

The PHP configuration for this setup is configured with the following limits:

- **Maximum Upload File Size**: 50 GB
- **Maximum Post Size**: 50 GB

## File Management

The dashboard provides functionalities to:

- Upload files up to the specified limit.
- View and manage uploaded files.
- Delete files if necessary.
