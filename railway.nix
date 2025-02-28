{ pkgs }: {
  deps = [
    pkgs.php82
    pkgs.php82Packages.composer
    pkgs.curl
    pkgs.git
    pkgs.unzip
    pkgs.bash
  ];
}
