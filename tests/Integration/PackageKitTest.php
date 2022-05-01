<?php

use Illuminate\Container\Container;
use PHPUnit\Framework\TestCase;
use Valet\CommandLine;
use Valet\PackageManagers\PackageKit;

class PackageKitTest extends TestCase
{
    protected function setUp(): void
    {
        $_SERVER['SUDO_USER'] = user();

        Container::setInstance(new Container);
    }


    protected function tearDown(): void
    {
        Mockery::close();
    }


    public function test_PackageKit_can_be_resolved_from_container()
    {
        $this->assertInstanceOf(PackageKit::class, resolve(PackageKit::class));
    }


    public function test_installed_returns_true_when_given_formula_is_installed()
    {
        $cli = Mockery::mock(CommandLine::class);
        $cli->shouldReceive('run')->once()
            ->with("pkcon search php7.0-cli | grep '^In' | sed 's/\s\+/ /g' | cut -d' ' -f2 | sed 's/-[0-9].*//'")
            ->andReturn('php7.0-cli');
        swap(CommandLine::class, $cli);
        $this->assertTrue(resolve(PackageKit::class)->installed('php7.0-cli'));
    }


    public function test_installed_returns_false_when_given_formula_is_not_installed()
    {
        $cli = Mockery::mock(CommandLine::class);
        $cli->shouldReceive('run')->once()
            ->with("pkcon search php7.0-cli | grep '^In' | sed 's/\s\+/ /g' | cut -d' ' -f2 | sed 's/-[0-9].*//'")
            ->andReturn('');
        swap(CommandLine::class, $cli);
        $this->assertFalse(resolve(PackageKit::class)->installed('php7.0-cli'));

        $cli = Mockery::mock(CommandLine::class);
        $cli->shouldReceive('run')->once()
            ->with("pkcon search php7.0-cli | grep '^In' | sed 's/\s\+/ /g' | cut -d' ' -f2 | sed 's/-[0-9].*//'")
            ->andReturn('php7.0-mcrypt');
        swap(CommandLine::class, $cli);
        $this->assertFalse(resolve(PackageKit::class)->installed('php7.0-cli'));
    }


    public function test_install_or_fail_will_install_packages()
    {
        $cli = Mockery::mock(CommandLine::class);
        $cli->shouldReceive('run')->once()->with('pkcon install -y dnsmasq', Mockery::type('Closure'));
        swap(CommandLine::class, $cli);
        resolve(PackageKit::class)->installOrFail('dnsmasq');
    }

    public function test_install_or_fail_throws_exception_on_failure()
    {
        $this->expectException(DomainException::class);
        $cli = Mockery::mock(CommandLine::class);
        $cli->shouldReceive('run')->andReturnUsing(function ($command, $onError) {
            $onError(1, 'test error ouput');
        });
        swap(CommandLine::class, $cli);
        resolve(PackageKit::class)->installOrFail('dnsmasq');
    }
}
