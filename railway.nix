{ pkgs }: {
  deps = [
    (import (fetchTarball "https://github.com/NixOS/nixpkgs/archive/1a57b9e2e9eb1934e870c192b463cb6204f5df2e.tar.gz") {}).php80  # PHP 8.0.2 from an older Nix package
    (import (fetchTarball "https://github.com/NixOS/nixpkgs/archive/1a57b9e2e9eb1934e870c192b463cb6204f5df2e.tar.gz") {}).php80Packages.composer  # Correct Composer version
    pkgs.curl
    pkgs.git
    pkgs.unzip
    pkgs.bash
  ];
}
